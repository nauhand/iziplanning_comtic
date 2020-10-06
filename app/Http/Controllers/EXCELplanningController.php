<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Planning_agent;
use App\Exports\planningDefinitifIndividuel;
use App\Exports\registreUnique;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Agent;

// use DB;

class EXCELplanningController extends Controller
{
    public function excelPlanningGen(Request $request) 
    {
        
        return Excel::download(new Planning_agent($request), 'ListePlanningsDefinitive_' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.xlsx');
        
    }

    public function excelPlanningIndiv(Request $request) 
    {  
        $agent = Agent::where('id', $request->id)->first();
        $excelPlanningIndiv = new planningDefinitifIndividuel($request);
        
        $titre = $agent->nom . '_' . $agent->matricule . 'Provisoire_' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download($excelPlanningIndiv, $titre . '.xlsx');
        
    }

    public function excelregistreUnique() 
    {
        
        $titre = 'registreUnique' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new registreUnique(), $titre . '.xlsx');
        
    }
    
}
