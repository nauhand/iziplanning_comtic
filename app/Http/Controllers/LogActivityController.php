<?php

namespace App\Http\Controllers;

use App\Helpers\BlackshFonctions;
use Validator;
use App\Models\Agent;
use App\Models\Conge;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Helpers\LogActivityHelper;
use App\Models\LogActivity;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LogActivityController extends Controller
{
  

    public function index() 
    {
        $user = User::all();
        $log_activies = LogActivityHelper::logActivityLists();
//        return view('pages.account.activity' , compact('log_activies','user'));
        return view('pages.account.activity_data' , compact('log_activies','user'));
    }
    public function getdata(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->from_agent) && empty($request->mois) && empty($request->annee))
            {
                $data =  DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->where('users.nom', $request->from_agent)
                    ->orderByDesc('log_activity.created_at')
                    ->get();
            }
            elseif (empty($request->from_agent) && !empty($request->mois) && empty($request->annee)) {
                $data = DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->whereYear('log_activity.created_at', '=', Carbon::today()->year)
                    ->whereMonth('log_activity.created_at', '=', Carbon::parse($request->mois)->month)
                    ->orderByDesc('log_activity.created_at')
                    ->get();
            }elseif (!empty($request->from_agent) && !empty($request->mois) && empty($request->annee)) {

                $data = DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->whereYear('log_activity.created_at', '=', Carbon::today()->year)
                    ->whereMonth('log_activity.created_at', '=', Carbon::parse($request->mois)->month)
                    ->where('users.nom', $request->from_agent)
                    ->orderByDesc('log_activity.created_at')
                    ->get();
            }elseif (empty($request->from_agent) && !empty($request->mois) && !empty($request->annee)) {
                $data =DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->whereMonth('log_activity.created_at', '=', Carbon::parse($request->mois)->month)
                    ->whereYear('log_activity.created_at', '=', $request->annee)
                    ->orderByDesc('log_activity.created_at')
                    ->get();
//
            }elseif (empty($request->from_agent) && empty($request->mois) && !empty($request->annee)) {
                $data =DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->orderByDesc('id')
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->whereYear('log_activity.created_at', '=', $request->annee)
                    ->get();

            }else
            {

               $data =  DB::table('log_activity')
                    ->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
                    ->orderByDesc('id')
                    ->join('users', 'log_activity.user_id', '=', 'users.id')
                    ->get();

            }
            return DataTables::of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? with(new Carbon($data->created_at))->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY') : '';})
                ->editColumn('nom', function ($data) {
                    $nom = $data->adminname . ' ' . $data->adminlastname ;
                    return $nom ;
                })
                ->editColumn('adressip', function ($data) {
                    return $data->ip ;
                })
                ->editColumn('ville', function ($data) {
                    return $data->ville ;
                })
                ->editColumn('region', function ($data) {
                    return $data->region ;
                })
                ->editColumn('subject', function ($data) {
                    return trim(($data->subject)) ;
                })
                ->editColumn('donne', function ($data) {
                    return trim(strtoupper($data->table)) ;
                })
                ->addColumn('action', 'action_user')
                ->make(true);
        }
    }

    public function search()
     {
        $user = User::all();
        return view('pages.account.search' , compact('user'));
     }

    public function show( $id ) 
    {   
        $logactivity = LogActivityHelper::logactivity( $id );

        switch ($logactivity[1]) {
            case 'sites':
                return view('pages.account.show' )->with('activity',$logactivity[0][0])->with('table','sites');
                break;
            case 'agent':
                return view('pages.account.show' )->with('activity',$logactivity[0][0])->with('table','agents');
                break;   
            case 'plannings':
                $vacations = LogActivityHelper::logplannings($logactivity[0][0]->table_id);
                return view('pages.account.show' )->with('activity',$logactivity[0][0])->with('table','plannings')->with('vacations',$vacations);
                break;
            case 'conges':
                return view('pages.account.show' )->with('activity',$logactivity[0][0])->with('table','conges');
                break;        
            default:
                exit();
                break;
        }
    }


    public function doRecherche(Request $request)
    {
        $logactivity = new LogActivity();
        if($request->ajax()) {
            if($request->type == null  && $request->userId == null && $request->action == null && $request->date_start == null && $request->date_end == null ) {
                $logactivity = LogActivityHelper::logActivityLists();
                return response()->json(['data' => $logactivity ], 200);
            } else {

         
            if($request->type !== null ) {
                switch( $request->type ) {
                    case 'agents' :
                        $logactivity = $logactivity->where('table', 'agent')->select(DB::raw(' log_activity.* ,  users.nom as username , users.prenoms as lastname , agents.nom as agentsnom , agents.prenoms as agentsprenom'))
                        ->join('agents', 'log_activity.table_id', '=', 'agents.id')
                        ->join('users', 'log_activity.user_id', '=', 'users.id')
                        ->join('departements', 'log_activity.user_id', '=', 'departements.id');
                        break ;
                    case 'conges' :
                        $logactivity = $logactivity->where('table', 'conges')->select(DB::raw(' log_activity.* , users.nom as username , users.prenoms as lastname , conges.* , agents.nom as agentnom , agents.prenoms as agentsprenom'))
                            ->join('users', 'log_activity.user_id', '=', 'users.id')
                            ->join('conges', 'log_activity.table_id', '=', 'conges.id')
                            ->join('agents', 'conges.agent_id', '=', 'agents.id') ;
                            // ->where('log_activity.table'), 'conges' );
                        break ;
                    case 'plannings' :
                        $logactivity = $logactivity->where('table', 'plannings')->select(DB::raw("log_activity.* , users.nom as username , users.prenoms as lastname ") )
                        ->join('users', 'log_activity.user_id', '=', 'users.id');
                        break ;    
                    default: 
                    $logactivity = $logactivity->where('table', 'sites')->select(DB::raw(" log_activity.* , users.nom as username , users.prenoms as lastname , sites.ville as sitesville , sites.nom as sitesnom , sites.adresse as sitesadresse , sites.telephone as sitestelephone , users.nom as username , users.prenoms as lastname ") )
                        ->join('sites', 'log_activity.table_id', '=', 'sites.id')
                        ->join('users', 'log_activity.user_id', '=', 'users.id');
                        break ;    
                        }
                    }
                    if($request->userId != null ) {
                        $logactivity = $logactivity->where(DB::raw('log_activity.user_id'),$request->userId );
                    }
                    if( $request->action !== null ) {
                        $logactivity = $logactivity->where(DB::raw('log_activity.severity_level'),$request->action);
                        // return response()->json(['data' => true], 200);
                    }
                    if( $request->date_start !== null && $request->date_end !== null ) {
                        $logactivity = $logactivity->whereBetween(DB::raw('log_activity.created_at'),[$request->date_start , $request->date_end] );

                    } else{
                        if($request->date_start !== null && $request->date_end == null  ) {
                        $logactivity =  $logactivity->where(DB::raw('log_activity.created_at') ,$request->date_start );
                        }
                    } 

            return response()->json(['data' => $logactivity->get()], 200);


         }
           
        
            
            
        }
       
    }
}
