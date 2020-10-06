<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Site;
use App\Models\Agent;
use App\Models\Conge;
use App\Models\Planning;
use App\Models\Jourferie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF ;




class BasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){

        //Mise à jour des vacations de la BD qui sont inférieur au premier du mois en cours
        $updatedata = array('statut'=> "archives");
        $is_archives = DB::table('plannings')
            ->where('date_debut', '<', Carbon::now()->startOfMonth())
            ->where('statut', 'definitif')
            ->update($updatedata);

        $plannings = Planning::select(DB::raw('*'))
            ->where('statut', 'archives')
            ->get();

        /** new Activity */


        $agentTotal=Agent::all()->count();
        $siteTotal=Site::all()->count();

        $PLANNING = Planning::all();

        $heureTotal = DB::table('plannings')
            ->select(DB::raw('SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit'))
            // ->where('date_debut', '>=',Carbon::today())
            ->where('date_debut', '>=',Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=',Carbon::now()->lastOfMonth())
            ->first();

        $heureTotalJour = $heureTotal->heure_total_jour;
        $heureTotalNuit = $heureTotal->heure_total_nuit;



        $agentDeployes = Planning::select(DB::raw('agent_id'))
            // -> where('statut','definitif')
            // -> where('date_debut', '>=',Carbon::today())
            ->where('date_debut', '>=',Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=',Carbon::now()->lastOfMonth())
            -> groupBy('agent_id')
            -> get()->count();



        $CONGES = Conge::All();

        $agentAbsents = $CONGES -> where('date_debut', '<=', Carbon::today())
            -> where('date_fin', '>=',Carbon::today())
            -> groupBy('agent_id')
            -> count();

//        dd($CONGES->count());
//        dd($CONGES);

        // dd($agentAbsents);

        $agentConges = $CONGES  -> where('date_debut', '<=', Carbon::today())
            -> where('date_fin', '>=',Carbon::today())
            -> where('typeconge', '=', 'congé')
            -> groupBy('agent_id')->count();

        $plannings = Planning::select(DB::raw('agent_id, id as id_plan , statut , site_id, date_debut as start, heure_debut as t'))
            ->where(DB::raw('YEAR(date_debut)'), '>=', Carbon::now()->year())
            // ->where('statut','definitif')
            ->orderBy('date_debut', 'asc')
            // ->groupBy('site_id')
            ->get();




        $monJson = [];
        foreach ($plannings as $key => $planning) {
            $monJson[]  = [
                'title'     => "h\n".$planning->site->nom ."\n(". $planning->agent->nom . ' ' . $planning->agent->prenoms.")",
                'start'     => $planning->start .'T' . $planning->t,
                'color'     => $planning->site->site_couleur,
                'editable'  => true,
                'overlap'   => true ,
                'url'        => '/gestion-planning/vacation/'.$planning->statut.'-'.$planning->id_plan ,
            ];
        }


        // $carbon = new Carbon('last day of January 2020', 'America/Vancouver');



        $plannings = json_encode($monJson);

        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);

        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {

            $data = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, SUM(heures_total) as heures_total, SUM(minutes) as minutes, SUM(minutes_jour) as minutes_jour, SUM(minutes_nuit) as minutes_nuit from plannings where  date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21"');
            if($data[0]->heure_total_jour == null && $data[0]->heure_total_nuit == null) {
                $data = 0 ;
            } else {
                $data = $data[0]->heure_total_jour +   $data[0]->heure_total_nuit ;
            }
        }elseif ($month == 1) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-01-01")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 4) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-04-02")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 7) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-14-07")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 8) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-08-15")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 11) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-11-01")
                ->orWhere('date_debut', $year."-11-11")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 12) {
            $data = DB::table('plannings')
                ->select('agents.id as ag_id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-12-25")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }else{
            $data = 0;
        }
        //$joursFerie = sizeof($joursFerie);

        return view('layouts.dashboard', compact('agentTotal','siteTotal','heureTotalJour','heureTotalNuit', 'plannings', 'agentDeployes', 'agentAbsents', 'agentConges', 'data'));
    }


    public  function vacation($status) {

        list($status , $id) = explode('-',$status);

        $p = DB::table('plannings')->select(
            DB::raw('plannings.*'),
            DB::raw('agents.nom as agentnom') ,
            DB::raw('agents.prenoms as agentprenom') ,
            DB::raw('sites.nom as sitenom'))
            ->join( 'agents',DB::raw('plannings.agent_id'), '=', DB::raw('agents.id'))
            ->join( 'sites',DB::raw('plannings.site_id'), '=', DB::raw('sites.id'))
            ->where(DB::raw('plannings.id'), '=',$id)
            ->where(DB::raw('plannings.statut') , '=', $status)
            ->get()[0];
//        dd($planning);
//        DB::table('plannings')->select('*' , DB::raw('agents.*') , DB::raw)
        return view('pages.plannings.vacation-only',compact('p'));
    }

    public  function  pdf($id) {

        $p = DB::table('plannings')->select(
            DB::raw('plannings.*'),
            DB::raw('agents.matricule'),
            DB::raw('agents.nom as agentnom') ,
            DB::raw('agents.prenoms as agentprenom') ,
            DB::raw('sites.nom as sitenom'))
            ->join( 'agents',DB::raw('plannings.agent_id'), '=', DB::raw('agents.id'))
            ->join( 'sites',DB::raw('plannings.site_id'), '=', DB::raw('sites.id'))
            ->where(DB::raw('plannings.id'), '=',$id)
            ->get()[0];

        $pdf    = PDF::loadView('pages.plannings.pdf.vacation-pdf', compact('p' ));

        $pdf->setPaper('A4');
        return $pdf->download('planning -'. $p->agentnom .'-'.$p->agentprenom. "-" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');

    }

}
