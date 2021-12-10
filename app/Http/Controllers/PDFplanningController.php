<?php

namespace App\Http\Controllers;

use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Site;
use App\Models\Agent;
use App\Models\Planning;
use App\Models\Conge;
use App\Models\Jourferie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFplanningController extends Controller
{
    public function getDataPlanning(Request $request, $id){

            $planning = Planning::findOrFail($id);
            $agents = Agent::all();
            $sites = Site::all();

            $pdf = PDF::loadView('pages/plannings/planning_agent_pdf', compact('planning', 'agent', 'sites'));
            $name = "planning-".$planning->id.".pdf";

            return $pdf->download($name);

    }

    public function planningDefinitif(Request $request)
    {

        if (! isset($request->idSite) && ! isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('*'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::today()->month)
            ->where('agent_id', $request->id)
            ->orderBy('date_debut', 'asc')
            ->get();

        }
        elseif ( isset($request->idSite) && ! isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('*'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::today()->month)
            ->where('agent_id', $request->id)
            ->where('site_id', $request->idSite)
            ->orderBy('date_debut', 'asc')
            ->get();

        }
        elseif (isset($request->idSite) && isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('*'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('agent_id', $request->id)
            ->where('site_id', $request->idSite)
            ->orderBy('date_debut', 'asc')
            ->get();

        }
        elseif (! isset($request->idSite) && isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('*'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('agent_id', $request->id)
            ->get();

        }
      
        
        // $plannings = Planning::select(DB::raw('*'))
        //             ->where('agent_id', $id->id)
        //             ->where('statut','definitif')
        //             ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
        //             ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
        //             // ->where('date_debut', '>=',Carbon::today())
        //             ->orderBy('date_debut', 'asc')
        //             ->get();

        $heures = Planning::select(DB::raw('sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('agent_id', $request->id)
                    ->where('statut','definitif')
                    ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                    ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                    // ->where('date_debut', '>=',Carbon::today())
                    // ->orderBy('date_debut', 'asc')
                    ->get();
        dd($heures);

        $heureFerieJour = 0;
        $heureFerieNuit = 0;
        $joursFerie = \App\Http\Controllers\PlanningController::jours_feries(Carbon::today()->format("Y"));
        
        foreach ($plannings as $value) {

            foreach ($joursFerie as $jour) {

                if ( Carbon::parse($value->date_debut)->format("m d") === Carbon::parse($jour)->format("m d") ) {
                    $heureFerieJour += $value->heure_total_jour;
                    $heureFerieNuit += $value->heure_total_nuit;
                }

            }
            
        }
        $id = Agent::where('id', $request->id)->first();
        // $joursFerie = array_filter($joursFerie, function($v, $k) {
        //     return strpos(Carbon::parse($v)->format("m"), Carbon::today()->format("m")) === 0;
        // }, ARRAY_FILTER_USE_BOTH);
                    // Planning::select(DB::raw('*'))
                    // ->where('agent_id', $agent->id)
                    // ->where('statut','definitif')
                    // ->where('date_debut', '>=',Carbon::today())
                    // ->get();
        // $joursFerie = \App\Http\Controllers\PlanningController::jours_feries(Carbon::today()->format("Y"));

        $pdf = PDF::loadView('pages.pdf.planningDefIndividuel', [
            'plannings'=>$plannings,
            'heure_jour'=> $heures[0]->heure_total_jour,
            'heure_nuit'=>$heures[0]->heure_total_nuit,
            'heureFerieJour' => $heureFerieJour,
            'heureFerieNuit' => $heureFerieNuit,
            // 'joursFerie' => $joursFerie
            ]);

        // $joursFerie = \App\Http\Controllers\PlanningController::jours_feries(Carbon::today()->format("Y"));

        return $pdf->download($id->nom . '_' . $id->matricule . 'Definitif_' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        // dump($plannings);
        // dd($joursFerie);
        // return view('pages.pdf.planningDefIndividuel', array( 
        //     'plannings'=>$plannings,
        //     'heure_jour'=> $heures[0]->heure_total_jour,
        //     'heure_nuit'=>$heures[0]->heure_total_nuit,
        //     'heureFerieJour' => $heureFerieJour,
        //     'heureFerieNuit' => $heureFerieNuit,
        //     'joursFerie' => $joursFerie
        // ));
    }

    public function planningDefinitifGeneral(Request $request)
    {

        if (! isset($request->idSite) && ! isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::today()->month)
            ->groupBy('agent_id')
            ->get();

        }
        elseif ( isset($request->idSite) && ! isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::today()->month)
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (isset($request->idSite) && isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (! isset($request->idSite) && isset($request->idMois)) {

            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->groupBy('agent_id')
            ->get();

        }

        // $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
        // ->where('statut','definitif')
        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
        // ->groupBy('agent_id')
        // ->get()
        // ->sortBy('agent_id.nom',SORT_REGULAR,false);
        
        $pdf = PDF::loadView('pages.pdf.planningDefGeneral', compact('plannings', 'joursFerie'));
        
        return $pdf->download('ListePlanningsDefinitive_' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');

    }

    public function agentAbsent()
    {
        $absences=Conge::where('date_debut', '>=', Carbon::now())
        ->orderBy('updated_at', 'desc')->get();

        $pdf = PDF::loadView('pages.pdf.agentAbsent', compact('absences'));
        return $pdf->download('agentAbsent' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        
        // return view('pages.absences.index',compact('absences'));
        // return view('pages.pdf.agentAbsent', compact('absences'));
    }

    public function registreUnique()
    {
        $agents = Agent::select(DB::raw('*'))
                    ->orderBy('nom', 'asc')
                    ->get();
        
        $pdf = PDF::loadView('pages.pdf.registreUnique', compact('agents'));
        // dd($pdf);

        // return view('pages.pdf.registreUnique',compact('agents'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('registreUnique' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
    }

    public function site(){

        $sites  = Site::select(DB::raw('*'))
                    ->orderBy('nom', 'asc')
                    ->get();
        $pdf    = PDF::loadView('pages.pdf.sites', compact('sites'));

        // return view('pages.pdf.registreUnique',compact('agents'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('listeSites' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        
    }
}
