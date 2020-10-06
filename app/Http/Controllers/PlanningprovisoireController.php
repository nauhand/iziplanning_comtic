<?php

namespace App\Http\Controllers;

use App\Exports\PlanninsgControllerExcel1;
use App\Helpers\LogActivityHelper;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Planning;
use App\Models\Agent;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Session;
use App\Exports\PlanninsgControllerExcel ;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class PlanningprovisoireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('pages.plannings.planning-provisoire');
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $agent = Agent::find($id);
        $plannings_1 = Planning::select(DB::raw(' date_debut, heure_debut, heure_fin'))
            ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
            ->where('agent_id', $id )
            ->orderBy('id', 'asc')
            ->orderBy('date_debut', 'asc')
            ->get();


        $tableau = [];

        foreach ($plannings_1 as $key => $value) {
            $tableau[$value['date_debut']] = $value['heure_debut'] . ' ' . $value['heure_fin'] ;
        }
        $tableau = json_encode($tableau);

        $plannings = Planning::select(DB::raw('*'))
            ->where('agent_id', $id)
            //->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'provisoire')
            ->orderBy('date_debut', 'asc')
            ->get();

        if($plannings->count() == 0) {
            return  redirect()->back()->with('info','Cet agent n\' a pas un planning pour le mois de '.Carbon::now()->monthName);
        }

        $totale = Planning::select( DB::raw("SUM(heures_total) as heures_total"),
            DB::raw("SUM(minutes) as minutes"))->where('agent_id', $id)->where('statut', 'provisoire')->get();

        $datecreation = Planning::select(DB::raw('*'))
            ->where('agent_id', $id)
            //->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'provisoire')
            ->groupBy('agent_id')
            ->get();

        $dateajout = Planning::select(DB::raw('*'), DB::raw("MAX(created_at) as latest"))
            ->where('agent_id', $id)
            //->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'provisoire')
            ->groupBy('agent_id')
            ->get();
        //dd($plannings[0]->vacation_id); die();
        $sites = Site::all()->sortBy('nom');

//        dd();
        //dd($datecreation); die();
        return view('pages.plannings.vacations-provisoire', compact('agent', 'plannings', 'sites', 'datecreation', 'dateajout', 'totale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $value = Agent::find($id);

        $statut = "definitif";

        $data = array('statut'=>$statut);

        $is_definitif = DB::table('plannings')
            ->where('agent_id', $id)
            //->where('vacation_id', $request->input('vacationid'))
            ->where('statut', "provisoire")
            ->update($data);

        if ($is_definitif) {
            //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log("Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en définitif !" , 3 , 'plannings', null );
            return redirect()->route('planning-provisoire')->with("success1","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en définitif !"  );

        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $value = Agent::find($id);

        $is_deleted = DB::table('plannings')
            ->where('agent_id', $id)
            //->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'provisoire')
            ->delete();

        if ($is_deleted) {

            //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log("successdelete","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." à été supprimé avec succès !", 3 , 'plannings', null );
            return redirect()->route('planning-provisoire')->with("successdelete","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." à été supprimé avec succès !"  );

        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }

    public function dataofcrea()
    {
        // mise à jour de tout les éléments du tableau provisoire
        $data = array('statut'=> "definitif");

        $is_definitif = DB::table('plannings')->where('statut', 'provisoire')->update($data);

        if ($is_definitif) {

            //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log('Les plannings ont été passés en définitifs ', 3,'plannings',null);
            return redirect()->route('planning-provisoire')->with('success','Tout les plannings ont été passés en définitifs !');

        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }
    public function plaTest() {
        $data = DB::table('plannings')
            ->select('agents.id as id', 'vacation_id', 'plannings.created_at',
                'agents.nom', 'agents.prenoms',
                DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                DB::raw("SUM(heures_total) as heures_total"),
                DB::raw("SUM(minutes) as minutes"), 'statut',
                DB::raw("SUM(minutes_jour) as minutes_jour"),
                DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                DB::raw("MAX(plannings.created_at) as latest_date"))
            ->where('statut', 'provisoire')
            ->join('agents', 'agents.id', '=', 'plannings.agent_id')
            ->groupBy('agent_id')
            //->groupBy('vacation_id')
            ->orderBy('latest_date', 'desc')
            ->get();

        $total = DB::table('plannings')
            ->select(DB::raw("SUM(heures_total) as heures_total"), DB::raw("SUM(minutes) as minutes"))
            ->where('statut', 'provisoire')->get();
        return view('pages.plannings.planning-provisoires',compact('data', 'total'));

    }

    public function dataplanning(Request $request)
    {
        if(request()->ajax())
        {
            if(empty($request->input('from_agent')))
            {
                $data = DB::table('plannings')
                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms', DB::raw("SUM(heure_total_jour) as heure_total_jour"), DB::raw("SUM(heure_total_nuit) as heure_total_nuit"), 'statut', DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'provisoire')
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();
            }
            elseif (!empty($request->input('from_agent'))){


                $data = DB::table('plannings')
                    ->select('agents.id as id','vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms', DB::raw("SUM(heure_total_jour) as heure_total_jour"), DB::raw("SUM(heure_total_nuit) as heure_total_nuit"), 'statut', DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'provisoire')
                    ->where('agents.nom', $request->input('from_agent'))
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();

            }
            return DataTables::of($data)
                ->editColumn('latest_date', function ($data) {
                    return $data->latest_date ? with(new Carbon($data->latest_date))->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY') : '';})
                ->editColumn('statut', function($data) {
                    return ' <span class="badge badge-secondary">'.$data->statut.'</span>';
                })
                ->addColumn('action', 'action')
                ->escapeColumns([])
                ->make(true);
        }
    }


    public function excels($type)
    {
        $titre = 'plannings-'.$type.'' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new PlanninsgControllerExcel($type), $titre . '.xlsx');

    }

    public function pdfs($type)
    {
        $plannings = \Illuminate\Support\Facades\DB::table('plannings')
            ->select('agents.id as id', 'vacation_id', 'plannings.created_at' , 'plannings.*',
                DB::RAW("agents.nom as agentnom"),
                DB::RAW("agents.prenoms as agentprenoms"),
                DB::RAW("sites.nom as sitenom"),
                DB::RAW("agents.prenoms as agentprenom"),
                DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                DB::raw("SUM(heures_total) as heures_total"),
                DB::raw("SUM(minutes) as minutes"), 'statut',
                DB::raw("SUM(minutes_jour) as minutes_jour"),
                DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                DB::raw("MAX(plannings.created_at) as latest_date"))
            ->where('statut', $type)
            ->join('agents', 'agents.id', '=', 'plannings.agent_id')
            ->join('sites', 'sites.id' , '=', 'plannings.site_id')
            ->groupBy('agent_id')
            //->groupBy('vacation_id')
            ->orderBy('latest_date', 'desc')
            ->get();
        $pdf    = PDF::loadView('pages.plannings.pdf.planning-type-pdf', compact('plannings','type'));

        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('plannings-' . $type. ''. ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');

    }


    public function excel($id)
    {
      
        $agent = Agent::find($id);
       
        $titre = 'planning -'. $agent->nom .'-'.$agent->prenoms. "- provisoire -" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        


        return Excel::download(new PlanninsgControllerExcel1($id), $titre . '.xlsx');

    }

    public function pdf($id)
    {
        //list($id , $data , $vaccation ) = explode('-',$id);
        $agent = Agent::find($id);

        /**   FERRIER */
        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);
        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {
            $planningsferies = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, SUM(heures_total) as heures_total, SUM(minutes) as minutes, SUM(minutes_jour) as minutes_jour, SUM(minutes_nuit) as minutes_nuit from plannings where agent_id = '.$id.' and statut = "provisoire" and (date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21")');
        }elseif ($month == 1) {
        }elseif ($month == 4) {
        }elseif ($month == 7) {
        }elseif ($month == 8) {
        }elseif ($month == 11) {
        }elseif ($month == 12) {
        }
        /**   FERRIER */

        $plannings = Planning::select(DB::raw('*'))
            ->where('agent_id', $id)
            //->where('vacation_id', $vaccation)
            ->where('statut', 'provisoire')
            ->orderBy('date_debut', 'asc')
            ->get();
        $sumhours = Planning::select(DB::raw('*'), DB::raw("SUM(heure_total_jour) as heure_total_jour"),
            DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
            DB::raw("SUM(heures_total) as heures_total"),
            DB::raw("SUM(minutes) as minutes") ,
            DB::raw("SUM(minutes_jour) as minutes_jour") ,
            DB::raw("SUM(minutes_nuit) as minutes_nuit")
        )
            ->where('agent_id', $id)
            //->where('vacation_id', $vaccation)
            ->where('statut', 'provisoire')
            ->orderBy('date_debut', 'asc')
            ->get();
        $pdf    = PDF::loadView('pages.plannings.pdf.planning-pdf', compact('plannings', 'agent', 'sumhours','planningsferies'));

        $pdf->setPaper('A4');
        return $pdf->download('planning -'. $agent->nom .'-'.$agent->prenoms. "- provisoire -" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        // return view('pages.plannings.pdf.planning-pdf', compact('plannings', 'agent', 'sumhours','planningsferies'));


    }

}

//planning-provisoire-pdf.blade