<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Jourferie;
Use App\Models\Planning;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;

class JourFerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //check les jours fériés dans la table fériés
        $feries = Jourferie::Select(DB::Raw('*'))
            ->where('dateincal', '>=', Carbon::now()->startOfMonth())
            ->where('dateincal', '<=', Carbon::now()->endOfMonth())
            ->get();

        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);

        //check si des agents existes dans les dates correspondantes

        if($month == 6) {

            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-06-10")
                ->orWhere('date_debut', $year."-06-08")
                ->orWhere('date_debut', $year."-06-01")
                ->orWhere('date_debut', $year."-06-21s")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
//            $data = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, SUM(heures_total) as heures_total, SUM(minutes) as minutes, SUM(minutes_jour) as minutes_jour, SUM(minutes_nuit) as minutes_nuit from plannings where
//date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21"');
//            if($data[0]->heure_total_jour == null && $data[0]->heure_total_nuit == null) {
//                $data = 0 ;
//            } else {
//                $data = $data[0]->heure_total_jour +   $data[0]->heure_total_nuit ;
//            }
        }
        elseif ($month == 5) {

            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-05-01")
                ->orWhere('date_debut', $year."-05-08")
                ->orWhere('date_debut', $year."-05-10")
                ->orWhere('date_debut', $year."-05-21")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 1) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-01-01")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 4) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-04-02")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 7) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-14-07")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 8) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-08-15")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 11) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-11-01")
                ->orWhere('date_debut', $year."-11-11")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }elseif ($month == 12) {
            $data = DB::table('plannings')
                ->select('agents.id as id','plannings.created_at', 'agents.nom', 'agents.prenoms', 'plannings.statut', 'plannings.id as pl_id', 'plannings.date_debut as date_debut', 'heure_total_jour', 'heure_total_nuit', 'pause', 'matricule', 'email', 'numeromobile' )
                //->where('statut', 'provisoire')
                ->where('date_debut', $year."-12-25")
                ->groupBy('agent_id')
                ->join('agents', 'agents.id', '=', 'plannings.agent_id')
                ->get();
        }else{
            $data = 0;
        }

        //dd($data);
        //dd($data->count()); die();

        return view('pages.absences.jour-ferie',compact('feries', 'data'));
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
    public function show($id)
    {
        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);
        // heure en cours $year."-05-01"
        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {
            $plannings = DB::select('select * from plannings inner join sites on plannings.site_id = sites.id where agent_id
                             = '.$id.' and (date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut =
                              "'.$year.'-06-01" or date_debut = "'.$year.'-06-21")');
        }elseif ($month == 1) {

        }elseif ($month == 4) {

        }elseif ($month == 7) {

        }elseif ($month == 8) {

        }elseif ($month == 11) {

        }elseif ($month == 12) {

        }

        //dd($plannings);
        return view('pages.absences.jour-ferie-vacations', compact('plannings'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
