<?php

namespace App\Http\Controllers;

use App\Exports\PlanningDefExport;
use App\Exports\PlanninsgControllerExcel_;
use App\Helpers\BlackshFonctions;
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
use App\Exports\PlanninsgDefControllerExcel ;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PlanningdefinitifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('plannings')
            ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms',
                DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                DB::raw("SUM(heures_total) as heures_total"),
                DB::raw("SUM(minutes) as minutes"), 'statut',
                DB::raw("SUM(minutes_jour) as minutes_jour"),
                DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                DB::raw("MAX(plannings.created_at) as latest_date"))
            ->where('statut', 'definitif')
            ->join('agents', 'agents.id', '=', 'plannings.agent_id')
            ->groupBy('agent_id')
            //->groupBy('vacation_id')
            ->orderBy('latest_date', 'desc')
            ->get();
        $total = DB::table('plannings')
            ->select(DB::raw("SUM(heures_total) as heures_total"), DB::raw("SUM(minutes) as minutes"))
            ->where('statut', 'definitif')->get();

        return view('pages.plannings.planning-definitif', compact('data','total'));
    }

    public function getdata(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->from_agent) && empty($request->mois))
            {
                $data = DB::table('plannings')
                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms',
                        DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                        DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                        DB::raw("SUM(heures_total) as heures_total"),
                        DB::raw("SUM(minutes) as minutes"), 'statut',
                        DB::raw("SUM(minutes_jour) as minutes_jour"),
                        DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                        DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'definitif')
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();
            }
            elseif (empty($request->from_agent) && !empty($request->mois)) {
                $data = DB::table('plannings')
                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms',
                        DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                        DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                        DB::raw("SUM(heures_total) as heures_total"),
                        DB::raw("SUM(minutes) as minutes"), 'statut',
                        DB::raw("SUM(minutes_jour) as minutes_jour"),
                        DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                        DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'definitif')
                    ->whereYear('plannings.created_at', '=', Carbon::today()->year)
                    ->whereMonth('plannings.created_at', '=', Carbon::parse($request->mois)->month)
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();
//                $data = DB::table('plannings')
//                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms', DB::raw("SUM(heure_total_jour) as heure_total_jour"), DB::raw("SUM(heure_total_nuit) as heure_total_nuit"), 'plannings.statut')
//                    ->where('statut', 'definitif')
//                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
//
//                    ->groupBy('agent_id')
//                    ->groupBy('vacation_id')
//                    ->get();
            }elseif (!empty($request->from_agent) && !empty($request->mois)) {
                $data = DB::table('plannings')
                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms',
                        DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                        DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                        DB::raw("SUM(heures_total) as heures_total"),
                        DB::raw("SUM(minutes) as minutes"), 'statut',
                        DB::raw("SUM(minutes_jour) as minutes_jour"),
                        DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                        DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'definitif')
                    ->where('agents.nom', $request->from_agent)
                    ->whereYear('plannings.created_at', '=', Carbon::today()->year)
                    ->whereMonth('plannings.created_at', '=', Carbon::parse($request->mois)->month)
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();
//                $data = DB::table('plannings')
//                    ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms', DB::raw("SUM(heure_total_jour) as heure_total_jour"), DB::raw("SUM(heure_total_nuit) as heure_total_nuit"), 'plannings.statut')
//                    ->where('statut', 'definitif')
//                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
//                    ->where('agents.nom', $request->from_agent)
//                    ->whereYear('plannings.created_at', '=', Carbon::today()->year)
//                    ->whereMonth('plannings.created_at', '=', Carbon::parse($request->mois)->month)
//                    ->groupBy('agent_id')
//                    ->groupBy('vacation_id')
//                    ->get();
            }else
            {

                $data = DB::table('plannings')
                        ->select('agents.id as id', 'vacation_id', 'plannings.created_at', 'agents.nom', 'agents.prenoms',
                            DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                            DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                            DB::raw("SUM(heures_total) as heures_total"),
                            DB::raw("SUM(minutes) as minutes"), 'statut',
                            DB::raw("SUM(minutes_jour) as minutes_jour"),
                            DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                            DB::raw("MAX(plannings.created_at) as latest_date"))
                    ->where('statut', 'definitif')
                    ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                    ->groupBy('agent_id')
                    //->groupBy('vacation_id')
                    ->orderBy('latest_date', 'desc')
                    ->get();

            }
            return DataTables::of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? with(new Carbon($data->created_at))->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY') : '';})
                ->editColumn('heure_total_jour', function ($data) {
                    $p = $data ;
                    $heures_total_hours = $p->heure_total_jour + intval(($p->minutes_jour / 60));
                    $minutes_jours = intval(($p->minutes_jour / 60))  >  0 ? (int)$p->minutes_jour % 60 : (int)$p->minutes_jour ;
                    return BlackshFonctions::format($heures_total_hours.':'.$minutes_jours.':00');})
                ->editColumn('heure_total_nuit', function ($data) {
                    $p = $data ;
                    $heure_total_nuit = $p->heure_total_nuit + intval(($p->minutes_nuit / 60));
                    $minutes_nuit = intval(($p->minutes_nuit / 60))  >  0 ? (int)$p->minutes_nuit % 60 : (int)$p->minutes_nuit ;
                    return BlackshFonctions::format($heure_total_nuit.':'.$minutes_nuit.':00');})
                ->editColumn('heures_total', function ($data) {
                    $p = $data ;
//                    $heure_total_nuit = $p->heure_total_nuit + intval(($p->minutes_nuit / 60));
//                    $minutes_nuit = intval(($p->minutes_nuit / 60))  >  0 ? (int)$p->minutes_nuit % 60 : (int)$p->minutes_nuit ;
                    $total = $p->heures_total + intval(($p->heures_total / 60));
                    $minutes = intval(($p->minutes / 60))  >  0 ? (int)$p->minutes % 60 : (int)$p->minutes ;
                    return BlackshFonctions::format($total.':'.$minutes.':00');})
                ->editColumn('statut', function($data) {
                    return ' <span class="badge badge-success" style="background-color: green !important;">'.$data->statut.'</span>';
                })
                ->addColumn('action', 'action-def')
                ->escapeColumns([])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $plannings = Planning::select(DB::raw('*'))
            ->where('agent_id', $id)
            ->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'definitif')
            ->orderBy('date_debut', 'asc')
            ->get();
        $totale = Planning::select( DB::raw("SUM(heures_total) as heures_total"),
            DB::raw("SUM(minutes) as minutes"))->where('agent_id', $id)->where('statut', 'definitif')->get();

        //dd($plannings[0]->vacation_id); die();
        $sites = Site::all()->sortBy('nom');

        return view('pages.plannings.vacations-definitif', compact('agent', 'plannings', 'sites', 'totale'));
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
        if($request->type == 'archived')
        {


            $value = Agent::find($id);

            $statut = "archives";

            $data = array('statut'=>$statut);

            $is_archived = DB::table('plannings')
                ->where('agent_id', $id)
                ->where('vacation_id', $request->input('vacationid'))
                ->where('statut', "definitif")
                ->update($data);

            if ($is_archived) {

                LogActivityHelper::log("Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en archivé !"  , 3 , 'plannings', 0 );
                return redirect()->route('planning-definitif')->with("success1","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en archivé !");

            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectué !');

            }
        }elseif($request->type == 'provisoire')
        {

            $value = Agent::find($id);

            $statut = "provisoire";

            $data = array('statut'=>$statut);

            $is_provisoire = DB::table('plannings')
                ->where('agent_id', $id)
                ->where('vacation_id', $request->input('vacationid'))
                ->where('statut', "definitif")
                ->update($data);

            if ($is_provisoire) {

                //Session::flash('success', 'Mise à jour éffectué !');
                LogActivityHelper::log("Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en provisoire !"  , 3 , 'plannings', 0 );
                return redirect()->route('planning-definitif')->with("success1","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." est passé en provisoire !"  );

            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectué !');

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Agent::find($id);

        $is_deleted = DB::table('plannings')
            ->where('agent_id', $id)
            // ->where('vacation_id', $request->input('vacationid'))
            ->where('statut', 'definitif')
            ->delete();

        if ($is_deleted) {

            //Session::flash('success', 'Mise à jour éffectué !');
            return redirect()->route('planning-definitif')->with("successdelete","Le planning de l'agent : ".$value->nom.' '.$value->prenoms." à été supprimé avec succès !"  );

        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }

    public function crea()
    {
        // mise à jour de tout les éléments du tableau provisoire
        $data = array('statut'=> "archives");

        $is_archives = DB::table('plannings')->where('statut', 'definitif')->update($data);

        if ($is_archives) {

            //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log('Les plannings ont été passés en archive ', 3,'plannings',0);
            return redirect()->route('planning-definitif')->with('success','Tout les plannings ont été passés en archivés !');

        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

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
        $titre = 'planning -'. $agent->nom .'-'.$agent->prenoms. "- definitif -" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new PlanningDefExport($id), $titre . '.xlsx');

    }

    public function pdf($id)
    {
        //list($id , $data , $vaccation ) = explode('-',$id);
        $agent = Agent::find($id);


        $plannings = Planning::select(DB::raw('*'))
            ->where('agent_id', $id)
            //->where('vacation_id', $vaccation)
            ->where('statut', 'definitif')
            ->orderBy('date_debut', 'asc')
            ->get();
        /**   FERRIER */
        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);
        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {
            $planningsferies = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, SUM(heures_total) as heures_total, SUM(minutes) as minutes, SUM(minutes_jour) as minutes_jour, SUM(minutes_nuit) as minutes_nuit from plannings where agent_id = '.$id.' and statut = "definitif" and (date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21")');
        }elseif ($month == 1) {
        }elseif ($month == 4) {
        }elseif ($month == 7) {
        }elseif ($month == 8) {
        }elseif ($month == 11) {
        }elseif ($month == 12) {
        }
        /**   FERRIER */
        $sumhours = Planning::select(DB::raw('*'), DB::raw("SUM(heure_total_jour) as heure_total_jour"),
            DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
            DB::raw("SUM(heures_total) as heures_total"),
            DB::raw("SUM(minutes) as minutes") ,
            DB::raw("SUM(minutes_jour) as minutes_jour") ,
            DB::raw("SUM(minutes_nuit) as minutes_nuit")
        )
            ->where('agent_id', $id)
            //->where('vacation_id', $vaccation)
            ->where('statut', 'definitif')
            ->orderBy('date_debut', 'asc')
            ->get();
        $pdf    = PDF::loadView('pages.plannings.pdf.planning-pdf-definitif', compact('plannings', 'agent', 'sumhours','planningsferies'));

        $pdf->setPaper('A4');
        return $pdf->download('planning -'. $agent->nom .'-'.$agent->prenoms. "- definitif -" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        //return view('pages.plannings.pdf.planning-pdf', compact('plannings', 'agent', 'sumhours'));


    }

}
