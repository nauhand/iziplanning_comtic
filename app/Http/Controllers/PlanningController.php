<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Site;
use App\Models\Agent;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogActivityHelper;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Carbon::today());
        $statut='definitif';
        $general = false;

        $list_agents=Agent::all()->sortBy('nom');

        if ($request->ajax()) {

            if ($request->type == 'valider') {

                $agents = Agent::findOrFail($request->id);
                $planning = $agents->plannings()->where('statut', 'provisoire');
                $planning->update(['statut' => 'definitif']);
                $general = true;

                $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    ->groupBy('agent_id')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['statut'=>'succes','table_provisoire'=>$table_provisoire],200);

            }
            elseif ($request->type == 'validerIndividuel') {

                $planning = Planning::findOrFail($request->id);
                $planning->update(['statut' => 'definitif']);
                $general = false;

                $plannings = Planning::select(DB::raw('*'))
                    ->where('statut','provisoire')
                    ->where('agent_id', $planning->agent->id)
                    //->where('date_debut', '>=', Carbon::today())
                    // ->whereMonth('date_debut', '>=', Carbon::today()->month)
                    // ->whereYear('date_debut',Carbon::today()->year)
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);

            }
            elseif ($request->type == 'supprimer') {

                $agents = Agent::findOrFail($request->id);
                $planning = $agents->plannings()->where('statut', 'provisoire');
                $planning->delete();
                $general = true;

                $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    // ->whereMonth('date_debut', '>=', Carbon::today()->month)
                    // ->whereYear('date_debut',Carbon::today()->year)
                    ->groupBy('agent_id')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['statut'=>'succes','table_provisoire'=>$table_provisoire],200);

            }
            elseif ($request->type == 'supprimerIndividuel') {

                $planning = Planning::findOrFail($request->id);
                $planning->delete();

                $general = false;
                $plannings = Planning::select(DB::raw('*'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    // ->whereMonth('date_debut', '>=', Carbon::today()->month)
                    // ->whereYear('date_debut',Carbon::today()->year)
                    ->where('agent_id', $planning->agent->id)
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);

            }
            elseif ($request->type == 'retour') {
                $general = true;

                $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    ->groupBy('agent_id')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);
            }
            elseif ($request->type == 'modifier') {
                $general = false;

                $heures = $this->calcul_heure($request->heure_debut, $request->heure_fin);
                $heure_total_jour = $heures[0];
                $heure_total_nuit = $heures[1];

                $planning = Planning::findOrFail($request->id);

                $planning->update([
                        'site_id'=>$request->site_id,
                        'agent_id'=>$request->agent_id,
                        'date_debut'=>$request->date_debut,
                        'pause'=>$request->heure_pause,
                        'heure_debut'=>$request->heure_debut,
                        'heure_fin'=>$request->heure_fin,
                        'heure_total_jour'=>$heure_total_jour,
                        'heure_total_nuit'=>$heure_total_nuit,
                        'statut'=> 'provisoire'
                    ]
                );
                $plannings = Planning::select(DB::raw('*'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    ->where('agent_id', $planning->agent->id)
                    ->orderBy('date_debut', 'asc')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);
            }
            $general = false;

            $plannings = Planning::select(DB::raw('*'))
                ->where('statut','provisoire')
                //->where('date_debut', '>=', Carbon::today())
                // ->orderBy('updated_at', 'desc')
                ->orderBy('date_debut', 'asc')
                ->where('agent_id', $request->id)
                ->get();

            $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
            return response()->json(['table_provisoire'=>$table_provisoire],200);
        }
        $sites = Site::all()->sortBy('nom');

        $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->where('statut','provisoire')
            //where('date_debut', '>=', Carbon::now()->firstOfMonth() )
            ->groupBy('agent_id')
            ->paginate(5);
        // dd(Carbon::today()->Month);

        //dd($plannings); die();

        $list_agents=Agent::all()->sortBy('nom');

        $title='Provisoires';
        $general = true;


        // if($request->ajax()){
        //     return response()->json(['content'=>view('pages.plannings.index',compact('agents','action','title','statut', 'list_agents', 'plannings'))->renderSections()],200);
        // }

        return view('pages.plannings.index',compact('title','statut','general','list_agents', 'plannings','sites'));
        // ------------------------------------
        // $plannings =Planning::select(DB::raw('agent_id,heure_total_jour,heure_total_nuit'))
        //->where('statut','provisoire');
        // ->whereMonth('date_debut',Carbon::today()->format('m'))
        // ->get();

        // foreach ($plannings as $key => $value) {
        //     dd($value->agent->nom);
        //     # code...
        // }

        // $agents=$this->listPlannings($plannings);
        // $title='Provisoires';
        // $action=route('planning.search_planning');
        // $statut='provisoire';

        // if($request->ajax()){
        //     return response()->json(['content'=>view('pages.plannings.index',compact('agents','action','title','statut'))->renderSections()],200);
        // }

        // return view('pages.plannings.index',compact('agents','action','title','statut'));
    }

    public function provisoire_search(Request $request){
        // return response()->json(['requete'=>$request->all()],200);

        if($request->ajax()){

            $general = true;
            $statut = 'definitif';
            if ( ! isset($request->id) ) {

                if (isset($request->idAgent) && ! isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('agent_id', $request->idAgent)
                        ->groupBy('agent_id')
                        ->paginate(5);
                    // ->with(['agents' => function($query) {
                    //     $query->orderBy('nom');
                    //     $query->orderBy('prenoms');
                    // }])

                }
                elseif (isset($request->idAgent) && isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->paginate(5);

                }
                elseif (! isset($request->idAgent) && isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->paginate(5);

                }
                elseif (! isset($request->idAgent) && ! isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->groupBy('agent_id')
                        ->paginate(5);

                    $list_agents=Agent::all();

                    $title='Provisoire';
                    $general = true;
                    return view('pages.plannings.index',compact('title','statut','general','list_agents', 'plannings','sites'));

                }

                $general = true;

                $table_provisoire=view('pages.plannings.table_planning', compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 'requete'=>$request->all()],200);
            }
            elseif($request->type == "afficher"){

                if (isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('*'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('site_id', $request->idSite)
                        ->paginate(5);

                }else{

                    $plannings = Planning::select(DB::raw('*'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->orderBy('date_debut', 'asc')
                        ->where('agent_id', $request->id)
                        ->paginate(5);

                }

                $general = false;

                $table_provisoire=view('pages.plannings.table_planning', compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 'requete'=>$request->all()],200);

            }
            elseif($request->type == "retour"){

                $general = true;

                if (isset($request->idSite)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->get();

                }else{

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->groupBy('agent_id')
                        ->get();

                }

                // $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                // ->where('statut','provisoire')
                // //->where('date_debut', '>=', Carbon::today())
                // ->groupBy('agent_id')
                // ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire],200);

            }
            if ($request->type == 'valider') {

                $agents = Agent::findOrFail($request->id);
                $planning = $agents->plannings()->where('statut', 'provisoire');
                $planning->update(['statut' => 'definitif']);
                $general = true;

                $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    ->groupBy('agent_id')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['statut'=>'succes','table_provisoire'=>$table_provisoire],200);

            }
            elseif ($request->type == 'supprimer') {

                $agents = Agent::findOrFail($request->id);
                $planning = $agents->plannings()->where('statut', 'provisoire');
                $planning->delete();
                $general = true;

                $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    // ->whereMonth('date_debut', '>=', Carbon::today()->month)
                    // ->whereYear('date_debut',Carbon::today()->year)
                    ->groupBy('agent_id')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['statut'=>'succes','content'=>$table_provisoire],200);

            }
            elseif ($request->type == 'supprimerIndividuel') {

                $planning = Planning::findOrFail($request->id);
                $planning->delete();

                $general = false;
                $plannings = Planning::select(DB::raw('*'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    // ->whereMonth('date_debut', '>=', Carbon::today()->month)
                    // ->whereYear('date_debut',Carbon::today()->year)
                    ->where('agent_id', $planning->agent->id)
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire],200);

            }
            elseif ($request->type == 'modifier') {
                $general = false;

                $heures = $this->calcul_heure($request->heure_debut, $request->heure_fin);
                $heure_total_jour = $heures[0];
                $heure_total_nuit = $heures[1];

                $planning = Planning::findOrFail($request->id);

                $planning->update([
                        'site_id'=>$request->site_id,
                        'agent_id'=>$request->agent_id,
                        'date_debut'=>$request->date_debut,
                        'pause'=>$request->heure_pause,
                        'heure_debut'=>$request->heure_debut,
                        'heure_fin'=>$request->heure_fin,
                        'heure_total_jour'=>$heure_total_jour,
                        'heure_total_nuit'=>$heure_total_nuit,
                        'statut'=> 'provisoire'
                    ]
                );
                $plannings = Planning::select(DB::raw('*'))
                    ->where('statut','provisoire')
                    //->where('date_debut', '>=', Carbon::today())
                    ->where('agent_id', $planning->agent->id)
                    ->orderBy('date_debut', 'asc')
                    ->get();

                $table_provisoire=view('pages.plannings.table_planning',compact('plannings','statut', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);
            }

        }
        return response()->json(['requete'=>$request->all()],200);

        return
            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                // ->where('statut','definitif')
                //->where('date_debut', '>=', Carbon::today())
                // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                ->groupBy('agent_id')
                ->get()
                ->sortBy('agent_id.nom',SORT_REGULAR,false);

        $general = true;
        return view('pages.plannings.planningDefinitif',compact('list_agents','plannings','general', 'sites'));

    }

    public function definitif_search(Request $request){

        if($request->ajax()){

            $general = true;
            $statut = 'definitif';
            if ( ! isset($request->id) ) {

                if (isset($request->idAgent) && ! isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('agent_id', $request->idAgent)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && ! isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('agent_id', $request->idAgent)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (! isset($request->idAgent) && isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (! isset($request->idAgent) && isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('site_id', $request->idSite)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (! isset($request->idAgent) && ! isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (! isset($request->idAgent) && ! isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        //->where('date_debut', '>=', Carbon::today())
                        ->groupBy('agent_id')
                        ->get();

                }

                $general = true;

                $table_provisoire=view('pages.plannings.table_definitif', compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 'requete'=>$request->all(), 'time'=>Carbon::parse($request->idMois)->year],200);
            }
            elseif($request->type == "afficher"){

                if (! isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::today()->month)
                        ->where('agent_id', $request->id)
                        ->get();

                }
                elseif ( isset($request->idSite) && ! isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::today()->month)
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->get();

                }
                elseif (isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->get();

                }
                elseif (! isset($request->idSite) && isset($request->idMois)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->where('agent_id', $request->id)
                        ->get();

                }

                $general = false;

                $table_provisoire=view('pages.plannings.table_definitif', compact('plannings','statut', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 'requete'=>$request->all(), 'time'=>Carbon::parse($request->idMois)->year],200);

            }

        }
        /**
         * Requête de redirection get
         */
        return response()->json(['requete'=>$request->all()],200);

        return
            $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                // ->where('statut','definitif')
                //->where('date_debut', '>=', Carbon::today())
                // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                ->groupBy('agent_id')
                ->get()
                ->sortBy('agent_id.nom',SORT_REGULAR,false);

        $general = true;
        return view('pages.plannings.planningDefinitif',compact('list_agents','plannings','general', 'sites'));

    }

    public function search_planning(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'annee'=>'required|date_format:Y'
        ]);
        $annee=$request->annee;
        $mois=$request->mois;
        $word=$request->word;
        $statut=$request->statut;

        // dd($mois,Carbon::parse($mois)->format('m'));
        // dd($annee,$mois);
        // dd(Carbon::parse($annee)->format('y'),Carbon::parse($mois)->format('m'));
        $plannings =Planning::select(DB::raw('agent_id,sum(heure_total_jour) as heure_total_jour,sum(heure_total_nuit) as heure_total_nuit'))
            ->where('statut',$statut)
            ->whereYear('date_debut',$annee)
            ->where(function($query) use ($mois){
                if($mois!='all'){
                    return $query->whereMonth('date_debut',Carbon::parse($mois)->format('m'));
                }
            })
            // ->where(function($query) use ($word) {
            //     return $query->Where('heure_total_nuit','LIKE','%'.$word.'%')
            //     ->orWhere('heure_total_jour','LIKE','%'.$word.'%');
            // })
            ->groupBy('agent_id','date_debut')
            ->get();

        $agents=$this->listPlannings($plannings);

        $table_provisoire=view('pages.plannings.table_planning',compact('agents','statut'))->render();

        return response()->json(['statut'=>'succes','table_provisoire'=>$table_provisoire],200);
    }

    public function index_definitives(Request $request){

        $list_agents=Agent::all()->sortBy('nom');
        $sites = Site::all()->sortBy('nom');
        $general = true;

        if($request->ajax()){

            if (isset($request->id)) {

                if (isset($request->agent_name) && isset($request->annee) && ! isset($request->site)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('agent_id', $request->agent_name)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }
                elseif (isset($request->site) && !isset($request->agent_name)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->site)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }
                elseif (isset($request->site) && isset($request->agent_name)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->site)
                        ->where('agent_id', $request->agent_name)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }
                elseif (!isset($request->agent_name) && isset($request->annee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }
                elseif (isset($request->agent_name)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('agent_id', $request->agent_name)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }
                elseif (!isset($request->agent_name) && !isset($request->annee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                }

                $general = false;

                $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                return response()->json(['table_provisoire'=>$table_provisoire],200);

            }
            else{
                if (isset($request->agent_name) && isset($request->mois)) {

                    $general    = false;
                    $plannings  = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->agent_name)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->orderBy('date_debut', 'asc')
                        ->get();

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
                elseif (isset($request->site) && !isset($request->agent_name)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        // ->where('statut','definitif')
                        ->where('site_id', $request->site)
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->groupBy('agent_id')
                        ->get()
                        ->sortBy('agent_id.nom',SORT_REGULAR,false);

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
                elseif (isset($request->site) && isset($request->agent_name)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        // ->where('statut','definitif')
                        ->where('agent_id', $request->agent_name)
                        ->where('site_id', $request->site)
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->groupBy('agent_id')
                        ->get()
                        ->sortBy('agent_id.nom',SORT_REGULAR,false);

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
                elseif (!isset($request->agent_name) && isset($request->mois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->groupBy('agent_id')
                        ->get()
                        ->sortBy('agent_id.nom',SORT_REGULAR,false);

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
                elseif (isset($request->agent_name) && !isset($request->mois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->agent_name)
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->groupBy('agent_id')
                        ->get();

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
                elseif (!isset($request->agent_name) && !isset($request->mois)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        // ->where('statut','definitif')
                        ->where('date_debut', '>=',Carbon::today())
                        // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
                        // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
                        ->groupBy('agent_id')
                        ->get()
                        ->sortBy('agent_id.nom',SORT_REGULAR,false);

                    $table_provisoire=view('pages.plannings.table_definitif',compact('plannings', 'general'))->render();
                    return response()->json(['table_provisoire'=>$table_provisoire],200);

                }
            }

        }

        $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            // ->where('statut','definitif')
            //->where('date_debut', '>=', Carbon::today())
            // ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
            // ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
            ->groupBy('agent_id')
            ->get()
            ->sortBy('agent_id.nom',SORT_REGULAR,false);

        $general = true;
        return view('pages.plannings.planningDefinitif',compact('list_agents','plannings','general', 'sites'));
    }

    public function index_definitives_by_site(Site $id){

        $list_agents=Agent::all();
        $general = true;

        $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->where('statut','definitif')
            ->where('site_id', $id->id)
            //->where('date_debut', '>=', Carbon::today())
            ->groupBy('agent_id')
            ->get()
            ->sortBy('agent_id.nom',SORT_REGULAR,false);

        $general = true;
        return view('pages.plannings.planningDefinitif',compact('list_agents','plannings','general'));
    }

    public function show_planning_agent(Agent $id)
    {
        $agent = $id;

        $plannings = Planning::select(DB::raw('*'))
            ->where('agent_id', $agent->id)
            ->where('statut','definitif')
            ->where('date_debut', '>=',Carbon::today())
            ->orderBy('date_debut', 'asc')
            ->get();

        return view('pages.plannings.show_planning_agent', compact('plannings'));

    }

    public function delete_planning_agent(Agent $id){
        LogActivityHelper::log("Suppression d'un agent ", 3 , 'agent', $id->id);
        $id->delete();

        return back()->with('success', 'La suppression a été effectué avec succès');
    }

    public function index_archive(Request $request){

        $list_agents=Agent::all()->sortBy('nom');
        $sites = Site::all()->sortBy('nom');
        $general = true;

        if($request->ajax()){

            if (isset($request->id)) {
                $general = false;


                if (isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->get();

                }
                elseif (isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->get();

                }
                elseif (isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }
                else{

                    $plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $request->id)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->get();

                }

                $table_provisoire=view('pages.plannings.table_archive',compact('plannings', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 't'=>Carbon::today()->month-2],200);

            }
            else{

                $general = true;

                if (isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('site_id', $request->idSite)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('site_id', $request->idSite)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && !isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && !isset($request->idSite) && isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && !isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('agent_id', $request->idAgent)
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                elseif (!isset($request->idAgent) && isset($request->idSite) && !isset($request->idMois) && isset($request->idAnnee)) {

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->where('site_id', $request->idSite)
                        ->whereYear('date_debut', '=', $request->idAnnee)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }
                else{

                    $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
                        ->whereYear('date_debut', '=', Carbon::today()->year)
                        ->whereMonth('date_debut', '<', Carbon::today()->month)
                        ->whereMonth('date_debut', '>', Carbon::today()->month-2)
                        ->groupBy('agent_id')
                        ->get();

                }

                $table_provisoire=view('pages.plannings.table_archive',compact('plannings', 'general'))->render();
                return response()->json(['content'=>$table_provisoire, 'plannings'=>$plannings, 't'=>Carbon::today()->month-2],200);

            }

        }

        $plannings = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '<', Carbon::today()->month)
            ->whereMonth('date_debut', '>', Carbon::today()->month-2)
            ->groupBy('agent_id')
            ->get();

        $general = true;
        return view('pages.plannings.planningArchive',compact('list_agents','plannings','general','sites'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $agents = Agent::all()->sortBy('nom');
        $plannings = Planning::select(DB::raw('agent_id as id, date_debut, heure_debut, heure_fin'))
            ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
            ->orderBy('id', 'asc')
            ->orderBy('date_debut', 'asc')
            ->get();
        $sites = Site::all()->sortBy('nom');
        $tableau = [];

        foreach ($plannings as $key => $value) {
            $tableau[$value['id']][] =$value['date_debut'] . ' ' . $value['heure_debut'] . ' ' . $value['heure_fin'] ;
        }
        $tableau = json_encode($tableau);
        // dd($tableau);

        if($request->ajax()){
            return response()->json(['content'=>view('pages.plannings.create',compact('sites','agents', 'tableau'))->renderSections()],200);
        }

        //dd($tableau); die();
        return view('pages.plannings.create',compact('sites','agents', 'tableau'));
    }

    // public function genereHeure(){
    //     $test = strtotime('21:00');
    //     $heure_1 = strtotime('01:00');
    //     $tableau = [$test];

    //     while (date('H:i',$test) != date('H:i',strtotime('06:00'))) {
    //         $tableau[] = end($tableau) +  $heure_1;
    //         $test += $heure_1;
    //     }

    //     return $tableau;
    // }


    public function real_time_($heure_debut, $heure_fin) {

        $tableau = [ "test" ,"21","22","23","00","01","02","03","04","05","06"];

        list($heure_debut, $minutes_debut) = explode(':', $heure_debut);
        list($heure_fin, $minutes_fin) = explode(':', $heure_fin);

        $heure_debut = intval($minutes_debut) > 0 ? intval($heure_debut + 1) . ':00' : ($heure_debut) . ':00';
        $heure_fin = intval($minutes_fin) > 0 ? intval($heure_fin + 1) . ':00' : ($heure_fin) . ':00';


//        jj
        if(!array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' =>  + $minutes_debut  > 0 ? ((60 - $minutes_debut) + $minutes_fin) : 0 , 'nuit' => 0 ];
        }
        elseif(!array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' =>  $minutes_debut > 0 ? (60 - $minutes_debut) : 0  , 'nuit' =>  $minutes_fin ];
        } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' => $minutes_fin , 'nuit' =>  $minutes_debut > 0 ? (60 - $minutes_debut) : 0   ];
        } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['nuit' => $minutes_fin  + ( $minutes_debut > 0 ?  (60 - $minutes_debut) : 0) , 'jour' => 0 ];
        }
    }
    public function total_hours_diff($heuredeb,$heurefin)
    {
        $hd=explode(":",$heuredeb);
        $hf=explode(":",$heurefin);

        $hd[0]=(int)($hd[0]);
        $hd[1]=(int)($hd[1]);
        $hd[2]=(int)($hd[2]);

        $hf[0]=(int)($hf[0]);
        $hf[1]=(int)($hf[1]);
        $hf[2]=(int)($hf[2]);

        if($hf[2]<$hd[2]){
            $hf[1]=$hf[1]-1;
            $hf[2]=$hf[2]+60;
        }
        if($hf[1]<$hd[1]){
            $hf[0]=$hf[0]-1;
            $hf[1]=$hf[1]+60;
        }
        if($hf[0]<$hd[0]){
            $hf[0]=$hf[0]+24;
        }
        return (($hf[0]-$hd[0]).":".($hf[1]-$hd[1]).":".($hf[2]-$hd[2]));
    }
    public function calcul_heure($heure_debut, $heure_fin)
    {
        // je recupere la minute  sur l'heure .
        list($hours_total1 , $minutes , $second )= explode(':',$this->total_hours_diff($heure_debut.':00',$heure_fin.':00'));

        $times = $this->real_time_($heure_debut,$heure_fin);
        list($heure_debut, $minutes_debut) = explode(':', $heure_debut);
        list($heure_fin, $minutes_fin) = explode(':', $heure_fin);

        $heure_debut = $minutes_debut > 0 ? (($heure_debut + 1) != 24 ? ($heure_debut + 1) : ('00'))  . ':00' : ($heure_debut) . ':00';
        $heure_fin =  ($heure_fin) . ':00';


        // if minute a > 0 ; minute_a = 30 . et #heure_a = 15 .
        // if $minute_b > 0 ; minute_b = 12 et heure_b = 23
        $tableau = ["21", "22", "23", "00", "01", "02", "03", "04", "05", "06"];



        /// if(heure_a appatien a $tableau) { minute_nuit = $minute_a} if(heure_b appatien a $tableau) { alors minute_nuit = nuit}


        $test = strtotime($heure_debut);
        $heure_1 = strtotime($heure_fin);

        $heureNuit = 0;
        $heureJour = 0;
        $hours_total= 0 ;
        while (date('H', $test) != date('H', $heure_1)) {
            if (array_search(date('H',$test), $tableau) && array_search(date('H',$test+strtotime('01:00')), $tableau)) {
                $heureNuit++;
            }elseif (!array_search(date('H',$test), $tableau) && array_search(date('H',$test+strtotime('01:00')), $tableau)) {
                $heureNuit++;
            } else{
                $heureJour++;
            }
            $test += strtotime('01:00');
        }


        return [$heureJour, $heureNuit,$hours_total1 , $minutes , $times];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertion = [];
        $count_vacation = DB::table('plannings')->count()+1;
        $agent_id = $_POST['hidden_agent_name'][0] ;
        $plannings_1 = Planning::select('vacation_id')
            ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
            ->where('agent_id', $agent_id )
            ->orderBy('id', 'asc')
            ->orderBy('date_debut', 'asc')
            ->get();

        if($plannings_1->count() != 0) {
            $count_vacation = $plannings_1[0]->vacation_id ;
        }
        LogActivityHelper::log("Ajout d'un nouveau planning" , 1 , 'plannings', $count_vacation);
        $today=Carbon::today()->toDateTimeString();
        for($count = 0; $count<count($_POST['hidden_agent_name']); $count++)
        {
            //
            $heures = $this->calcul_heure($_POST['hidden_heure_debut'][$count], $_POST['hidden_heure_fin'][$count]);
            $heure_total_jour = $heures[0];
            $heure_total_nuit = $heures[1];
            $total_hours      =  $heures[2];
            $minutes          =  $heures[3];
            $minutes_data      =  $heures[4];
//                    dd($minutes_data);
            $insertion[] = [
                'site_id'=>$_POST['hidden_site_name'][$count],
                'agent_id'=>$_POST['hidden_agent_name'][$count],
                'date_debut'=>$_POST['hidden_date_debut'][$count],
                'pause'=>$_POST['hidden_heure_pause'][$count],
                'heure_debut'=>$_POST['hidden_heure_debut'][$count],
                'heure_fin'=>$_POST['hidden_heure_fin'][$count],
                'heure_total_jour'=>$heure_total_jour,
                'heure_total_nuit'=>$heure_total_nuit,
                'heures_total' =>intval( $total_hours) ,
                'minutes' => intval($minutes) ,
                'minutes_nuit' => intval($minutes_data['nuit']) ,
                'minutes_jour' => intval($minutes_data['jour']) ,
                'statut'=> 'provisoire',
                'vacation_id'=> $count_vacation,
                'created_at'=>$today,
                'updated_at'=>$today
            ];
        }
        DB::table('plannings')->insert($insertion);
//        session()->flash('notification', 'Planning créer avec succès !');
        return back()->with('notification','Planning créé avec succès!');
//        return response()->json(['message' => 'success'], 200);
//            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $agent=Agent::where('id',$id)->firstOrFail();
        $sites=Site::all();
        $plannings=$agent->plannings;
        // foreach ($plannings as $key => $planning) {
        //     dd($planning->site->nom);
        //     // dd(Carbon::create($planning->date_debut)->format('d'));
        // }
        if($request->ajax()){
            $form_edit_view=view('pages.plannings.planning_form_create',compact('sites','agent'))->render();
            return response()->json(['form_edit_view'=>$form_edit_view]);
        }
        return view('pages.plannings.show',compact('sites','agent','plannings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planning=Planning::where('id',$id)->firstOrFail();

        $sites=Site::all();
        $agent=$planning->agent;

        $form_edit_view=view('pages.plannings.planning_form_edit',compact('planning','sites','agent'))->render();

        return response()->json(['statut'=>'succes','msg'=>'Planning Supprimé','form_edit_view'=>$form_edit_view]);
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
        $v=$this->validationPlanning($request);

        if($v->fails()){
            if ($request->ajax()) {
                return response()->json($v->errors(),422);
            }
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }

        $planning=Planning::where('id',$id)->firstOrFail();
        //Enregistrements
        $planning->update([
            'site_id'=>$request->site,
            'agent_id'=>$request->agent,
            'date_debut'=>$request->date_debut,
            // 'date_fin'=>$request->date_fin,
            'pause'=>$request->pause,
            'heure_debut'=>Carbon::parse($request->heure_debut)->toTimeString(),
            'heure_fin'=>Carbon::parse($request->heure_fin)->toTimeString(),
            'heure_total_jour'=>$this->heure_total_jour($request),
            'heure_total_nuit'=>$this->heure_total_nuit($request),
            'statut'=>'provisoire',
        ]);

        if($request->ajax()){
            $plannings=Planning::where('agent_id',$request->agent)->get();
            $calendar_view=view('pages.plannings.calendar',compact('plannings'))->render();
            return response()->json(['statut'=>'succes','calendar_view'=>$calendar_view],200);
        }

        return redirect()->route('planning.show',$request->agent);
    }

    public function planningRapport($id)
    {
        setlocale(LC_TIME, "fr_FR");
        $agent=Agent::where('id',$id)->firstOrFail();
        $site=Site::where('id',$id)->firstOrFail();
        $planning= Planning::where('agent_id', $id)->firstOrFail();

        $last_date = Planning::where('agent_id', $id)->select('created_at')->orderBy('created_at', 'ASC')->first();
        $dataplanning=$agent->plannings->where('created_at', $last_date->created_at);
        $total_time_jour = Planning::where('agent_id', $id)->where('created_at', $last_date->created_at)->sum(DB::raw("TIME_TO_SEC(heure_total_jour)"));
        $total_time_nuit = Planning::where('agent_id', $id)->where('created_at', $last_date->created_at)->sum(DB::raw("TIME_TO_SEC(heure_total_nuit)"));

        $dataplanning=$agent->plannings->where('created_at', $last_date->created_at);
        $site=Site::find($id);
        return view('pages.plannings.siteParametre', compact('agent', 'site', 'dataplanning', 'planning', 'total_time_jour',
            'total_time_nuit', 'joursferie', 'data_nombreferie'));
    }

    public function validePlanning($id_agent)
    {
        $agent=Agent::findOrFail($id_agent);
        $moisCourent=Carbon::today()->format('m');
        $plannings=$agent->plannings()->whereMonth('date_debut',$moisCourent);
        //Modification du statut
        $plannings->update([
            'statut'=>'definitif',
        ]);

        return redirect()->back();
    }

    public function tabplanning(Request $request){
        $plannings=[];
        foreach(explode(',', implode($request->date_debut)) as $key => $datebe){
            $plannings[$key]["site_id"]=$request->site[$key];
            $plannings[$key]["agent_id"]=$request->agent;
            $plannings[$key]["date_debut"]=$datebe;
            $plannings[$key]["heure_debut"]=$request->heure_debut[$key];
            $plannings[$key]["heure_fin"]=$request->heure_fin[$key];
            $plannings[$key]["pause"]=$request->pause[$key];
            $plannings[$key]["jourferiefrancais"]=$request->jourferiefrancais;
        }
        return $plannings;
    }

    public function archivePlanning($id_agent)
    {
        $agent=Agent::findOrFail($id_agent);
        $moisCourent=Carbon::today()->format('m');
        $plannings=$agent->plannings()->whereMonth('date_debut',$moisCourent);
        //Modification du statut
        $plannings->update([
            'statut'=>'archive',
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planning=Planning::where('id',$id)->firstOrFail();
        $agent_id=$planning->agent_id;
        $result=$planning->delete();

        $plannings=Planning::where('agent_id',$agent_id)->get();
        $calendar_view=view('pages.plannings.calendar',compact('plannings'))->render();

        if($result){
            return response()->json(['statut'=>'succes','msg'=>'Planning Supprimé','calendar_view'=>$calendar_view]);
        }
        else{
            return response()->json(['statut'=>'echec','msg'=>'Erreur, veuillez réessayer svp !','calendar_view'=>$calendar_view]);
        }
    }

    public function destroyAllPlannings($id_agent)
    {
        $agent=Agent::findOrFail($id_agent);
        $moisCourent=Carbon::today()->format('m');
        $plannings=$agent->plannings()->whereMonth('date_debut',$moisCourent);
        //Modification du statut
        $plannings->delete();

        return redirect()->back();
    }

    public function validationPlanning(REquest $request){
        $v=Validator::make($request->all(),[
            'site'=>'required|exists:sites,id',
            'agent'=>'required|exists:agents,id',
            'date_debut'=>'required',
            'pause'=>'required',
            'heure_debut'=>'required',
            'heure_fin'=>'required'
            // 'date_fin'=>'required',

            // 'heure_fin'=>'required|date_format:H:i'
        ]);

        return $v;
    }

    /*
    public function listPlannings($collection){
        $agentArray=[];
        $planningsArray=[];
        //Onrecuperes les info de l'agent et le nombre total d'heure en jour
        foreach ($collection as $key => $planning) {
            if($planning->heure_total_jour!=0){
                $agentArray[$key]['agent_id']=$planning->agent_id;
                $agentArray[$key]['nom']=$planning->agent->nom;
                $agentArray[$key]['prenoms']=$planning->agent->prenoms;
                $agentArray[$key]['numeromobile']=$planning->agent->numeromobile;
                $agentArray[$key]['statut']=$planning->agent->statut;
                $agentArray[$key]['heure_total_jour']=$planning->heure_total_jour; 
                $agentArray[$key]['heure_total_nuit']=$planning->heure_total_nuit; 
            }
        }

        // dd($agentArray);
        // //Onrecurepe le nombre ttal heure en nuit
        // foreach ($collection as $key => $planning) {
        //     if($planning->heure_total_nuit!=0){
        //         $planningsArray[]['heure_total_nuit']=$planning->heure_total_nuit;
        //     }
        // }
        // //On ajoute le nombre total d'heure en nuit de chaque agent
        // foreach ($agentArray as $key => $agent) {
        //     $agentArray[$key]['heure_total_nuit']=abs($planningsArray[$key]['heure_total_nuit']);
        // }

        return $agentArray;
    }
    
    public function heure_total_jour(Request $request){
        //difference between two dates
        $date_debut = date_create($request->date_debut);
        // $date_fin = date_create($request->date_fin);            
        //Nombre de jours
        // $nbrJours= date_diff($date_debut,$date_fin)->format("%a")+1;
        $heure_debut = Carbon::parse($request->heure_debut);
        $heure_fin = Carbon::parse($request->heure_fin);
        //Nombre d'heure
        $hours = $heure_fin->diffInHours($heure_debut);
        //Heure de jour est 15h maximum
        $margeHeure=0;
        if($hours>15){
            $margeHeure=$hours-15;
            $hours=15;
        }

        if($request->jourferie==='on'){
            $hours = $heure_fin->diffInHours($heure_debut)*2;
        }
        // dd($hours);
        // dd($nbrJours);
        if($heure_debut->toTimeString()>='21:00:00' || ($heure_debut->toTimeString()>='00:00:00' && $heure_debut->toTimeString()<'06:00:00')){
            //Nombre total heure de nuit
            $nbreTotalHeure=$margeHeure;
            return $nbreTotalHeure;
        }else{
            //Nombre total heure de jour
                //Si le mois contient des jours fériés alors on double les heures
                if(!$request->jourferiefrancais==='on')
                    $request['nbre_ferie']=0;
            $nbreTotalHeure=(1+$request['nbre_ferie'])*$hours;
            //count days
            return $nbreTotalHeure;
        }

    }

    public function heure_total_nuit(Request $request){
        //Onrecupere les jours feries
        // $jousferie=Jourferie::all()->toArray();
        $jousferie=Jourferie::select('dateferie')->pluck('dateferie')->toArray();
        //difference between two dates
        $date_debut = date_create($request->date_debut);
        // $date_fin = date_create($request->date_fin);            
        //Nombre de jours
        // $nbrJours= date_diff($date_debut,$date_fin)->format("%a")+1;
        $heure_debut = Carbon::parse($request->heure_debut);
        $heure_fin = Carbon::parse($request->heure_fin);
        //Nombre d'heure
        $hours = $heure_fin->diffInHours($heure_debut);
        //Heure de nuit est 15h maximum
        $margeHeure=0;
        if($hours>10){
            $margeHeure=$hours-10;
            $hours=10;
        }
        // dd(in_array(Carbon::parse($request->date_debut)->format('d-m'), $jousferie));
        if($request->jourferie==='on'){
            $hours = $heure_fin->diffInHours($heure_debut)*2;
        }
        // dd($nbrJours);
        // dd($heure_debut->toTimeString()>='06:00:00' && $heure_debut->toTimeString()<='21:00:00');
        if($heure_debut->toTimeString()>='21:00:00' || ($heure_debut->toTimeString()>='00:00:00' && $heure_debut->toTimeString()<'06:00:00')){
            //Nombre total heure de nuit
                //Si le mois contient des jours fériés alors on double les heures
                if(!$request->jourferiefrancais==='on')
                    $request['nbre_ferie']=0;
            $nbreTotalHeure=(1+$request['nbre_ferie'])*$hours;
            //count days
            return $nbreTotalHeure;
        }else{
            //Nombre total heure de jour
            $nbreTotalHeure=$margeHeure;
            return $nbreTotalHeure;
        }
    }

    //Fonction de planning
    function planningsArray(Request $request){
        //Recuperer les dates
        $dateDeb=Carbon::parse($request->heure_debut);
        $dateFin=Carbon::parse($request->heure_fin);
        //Caluculer le nombre de mois entre ces deux dates
        // $nbrMois=$dateDeb->diffInMonths($dateFin)+1;
        // dd($nbrMois);
        //Declaration variable
        $plannings=[];
        //Initialisation de i qui va permetre de avoir si nous somme au debut de l'itération
        $i=0;
        //On reucpere le tableau des jours feries
        $joursferies=Jourferie::all()->toArray();
        // dd($joursferies);
        $tab=[];


        $jousferie=Jourferie::select('dateferie')->pluck('dateferie')->toArray();
        while (strtotime($dateDeb)<=strtotime($dateFin)) {
            // print_r($dateDeb."<br/>");

            $debut=Carbon::parse($dateDeb);
            $fin=Carbon::parse($dateDeb);
            //Remplissage du tablau de planing
            $plannings[$i]['site_id']=$request->site;
            $plannings[$i]['agent_id']=$request->agent;
            //On choisie la date de dept si on est a la premiere iteration sinon on 
            //prend le dernier jour de la date
            if($i==0){
                $plannings[$i]['date_debut']=Carbon::parse($request->date_debut)->toDateString();
                $request['date_debut']=Carbon::parse($request->date_debut)->toDateString();
            }else{
                $plannings[$i]['date_debut']=Carbon::parse($request->date_debut)->startOfMonth()->toDateString();
                $request['date_debut']=Carbon::parse($request->date_debut)->startOfMonth()->toDateString();
            }
            //On choisi la date de fin saisie si on est a la derniere itération sinon on prend le dernier
            //jour de la date
            // if($debut->format('m')==$dateFin->format('m')){
            //     $plannings[$i]['date_fin']=$dateFin->toDateString();
            //     $request['date_fin']=$dateFin->toDateString();
            // }else{
            //     $plannings[$i]['date_fin']=$fin->endOfMonth()->toDateString();
            //     $request['date_fin']=$fin->endOfMonth()->toDateString();
            // }
            $plannings[$i]['heure_debut']=$request->heure_debut;
            $plannings[$i]['heure_fin']=$request->heure_fin;
            $plannings[$i]['pause']=$request->pause;
            //On vérifie s'il n'y a pas de jour ferie dans cette periode
            $request['nbre_ferie']=$this->checkJourFerie($joursferies,$request['date_debut'],$request['date_fin']);
            $tab[]=$request['nbre_ferie'];
            $plannings[$i]['heure_total_jour']=$this->heure_total_jour($request);
            $plannings[$i]['heure_total_nuit']=$this->heure_total_nuit($request);
            $plannings[$i]['statut']='provisoire';
            $today=Carbon::today()->toDateTimeString();
            $plannings[$i]['created_at']=$today;
            $plannings[$i]['updated_at']=$today;
            $i++;
            //On passe au mois prochain
            if(Carbon::parse($dateDeb)->format('d')==31){
                $dateDeb=Carbon::parse($dateDeb)->addDay(1)->toDateString();
            }else{
                $dateDeb=Carbon::parse($dateDeb)->addMonth(1)->toDateString();
            }
            // $dateDeb=Carbon::parse($dateDeb)->addMonth(1)->toDateString();
            // $dateDeb=date('Y-m-d',strtotime('+1 month',strtotime($dateDeb)));
            // dd($dateDeb);
        }

        // dd($tab);
        return $plannings;
    }

    public function checkJourFerie($joursferies=[],$dateDeb,$dateFin){
        // dd($joursferies,$dateDeb,$dateFin);
        $nbre_ferie=0;
        foreach ($joursferies as $key => $joursferie) {
            $jour=Carbon::today()->format('Y').'-'.$joursferie['dateferie'];
            $paymentDate = new DateTime($jour); // Today
            $contractDateBegin = new DateTime($dateDeb);
            $contractDateEnd  = new DateTime($dateFin);
            if (
                $paymentDate->getTimestamp() >= $contractDateBegin->getTimestamp() && 
                $paymentDate->getTimestamp() <= $contractDateEnd->getTimestamp()){
                // dd('Ferie');
                $nbre_ferie++;
            }
        }
        return $nbre_ferie;
    }*/

    /*|---------------------------------------------------------------|*/
    /*|              GESTION DES JOURS FERIÉS EN FRANCE               |
    /*|---------------------------------------------------------------|*/

    public static function dimanche_paques($annee)
    {
        return date("Y-m-d", easter_date($annee));
    }
    public static function vendredi_saint($annee)
    {
        $dimanche_paques = self::dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques -2 day"));
    }
    public static function lundi_paques($annee)
    {
        $dimanche_paques = self::dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +1 day"));
    }
    public static function jeudi_ascension($annee)
    {
        $dimanche_paques = self::dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +39 day"));
    }
    public static function lundi_pentecote($annee)
    {
        $dimanche_paques = self::dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +50 day"));
    }

    public static function jours_feries($annee, $alsacemoselle=false)
    {
        $jours_feries = array
        (    self::dimanche_paques($annee)
        ,    self::lundi_paques($annee)
        ,    self::jeudi_ascension($annee)
        ,    self::lundi_pentecote($annee)

        ,    "$annee-01-01"        //    Nouvel an
        ,    "$annee-05-01"        //    Fête du travail
        ,    "$annee-05-08"        //    Armistice 1945
        ,    "$annee-05-15"        //    Assomption
        ,    "$annee-07-14"        //    Fête nationale
        ,    "$annee-11-11"        //    Armistice 1918
        ,    "$annee-11-01"        //    Toussaint
        ,    "$annee-12-25"        //    Noël
        );
        if($alsacemoselle)
        {
            $jours_feries[] = "$annee-12-26";
            $jours_feries[] = self::vendredi_saint($annee);
        }
        sort($jours_feries);
        return $jours_feries;
    }

    function est_ferie($jour, $alsacemoselle=false)
    {
        $jour = date("Y-m-d", strtotime($jour));
        $annee = substr($jour, 0, 4);
        return in_array($jour, self::jours_feries($annee, $alsacemoselle));
    }

}
