<?php

namespace App\Http\Controllers;

use App\Helpers\BlackshFonctions;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Planning;
use DB;
use Session;
Use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;

class GestionSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sitesListe = Site::select(DB::raw('*'))
            ->orderBy('nom', 'asc')
            ->get();

        return view('pages.sites.liste-site', compact('sitesListe'));
    }

    public function dataagent()
    {

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
        $site = Site::find($id);

        $planningSite = Planning::select(DB::raw('*'))
            ->where('site_id', $id)
            ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=', Carbon::now()->endOfMonth())
            //->groupBy('agent_id')
            ->orderBy('date_debut', 'asc')
            ->get();

        $datahours = Planning::select(DB::raw('SUM(heure_total_jour) as heure_total_jour'),
            DB::raw('SUM(heure_total_nuit) as heure_total_nuit')  ,
            DB::raw('SUM(heures_total) as total')  ,
            DB::raw('SUM(minutes) as minutes') ,
            DB::raw('SUM(minutes_jour) as minutes_jour') ,
            DB::raw('SUM(minutes_nuit) as minutes_nuit')
        )
            ->where('site_id', $id)
            ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=', Carbon::now()->endOfMonth())
            //->groupBy('agent_id')
            ->orderBy('date_debut', 'asc')
            ->get();

        /**   FERRIER */
        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);
        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {
            $planningsferies = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, 
                            SUM(heures_total) as heures_total,
                             SUM(minutes) as minutes,
                              SUM(minutes_jour) as minutes_jour, 
                              SUM(minutes_nuit) as minutes_nuit 
                              from plannings
                              inner join sites on plannings.site_id = sites.id
                               where site_id = '.$id.' 
                              and (date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21")');
        }elseif ($month == 1) {
        }elseif ($month == 4) {
        }elseif ($month == 7) {
        }elseif ($month == 8) {
        }elseif ($month == 11) {
        }elseif ($month == 12) {
        }
        /**   FERRIER */

        //dd($planningSite); die();
        //dd($planningSite);
        return view('pages.sites.liste-agent-site', compact('site', 'planningSite', 'datahours', 'id', 'planningsferies'));
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

    public function real_time_($heure_debut, $heure_fin) {

        $tableau = [ "test" ,"21","22","23","00","01","02","03","04","05","06"];

        list($heure_debut, $minutes_debut) = explode(':', $heure_debut);
        list($heure_fin, $minutes_fin) = explode(':', $heure_fin);

        $heure_debut = $minutes_debut > 0 ? ($heure_debut + 1) . ':00' : ($heure_debut) . ':00';
        $heure_fin = $minutes_fin > 0 ? ($heure_fin + 1) . ':00' : ($heure_fin) . ':00';

        //        jj
        if(!array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' =>  $minutes_debut == 0 ? 00 : (60 - $minutes_debut) + $minutes_fin , 'nuit' => 0 ];
        }
        elseif(!array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' =>  $minutes_debut == 0 ? 00 : (60 - $minutes_debut)  , 'nuit' =>  $minutes_fin ];
        } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['jour' => $minutes_fin , 'nuit' =>   $minutes_debut == 0 ? 00 : (60 - $minutes_debut) ];
        } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
            return  ['nuit' => $minutes_fin  +  ($minutes_debut == 0 ? 00 :(60 - $minutes_debut)) , 'jour' => 0 ];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validation des champs de formulaire
        /*$this->validate($request,[
            'sitename' => ['required', 'not_in:0'],
            'datedebut' => ['required', 'date' , 'date_format:d-m-Y'],
            'heuredebut' => ['required'],
            'heurefin' => ['required'],
            'heurepause' => ['required'],
        ]);*/

        // debut de la mise à jour d'une vacation

        $sitename = $request->input('sitename');
        $datedebut = $request->input('datedebut');
        $heuredebut = $request->input('heuredebut');
        $heurefin = $request->input('heurefin');
        $heurepause = $request->input('heurepause');

        // récupération du nombre d'heure de jour et de nuit

        $heures = $this->calcul_heure($heuredebut, $heurefin);
        $heure_total_jour = $heures[0];
        $heure_total_nuit = $heures[1];
        $heure_total      = $heures[2];
        $minutes      = $heures[3];
        $minutes_data      =  $heures[4];

        //dd($heure_total_nuit); die();

        $data = array('site_id'=>$sitename,
            'date_debut'=>$datedebut,
            'heure_debut'=>$heuredebut,
            'heure_fin'=>$heurefin,
            'pause'=>$heurepause,
            'heure_total_jour'=>$heure_total_jour,
            'heure_total_nuit'=>$heure_total_nuit ,
            'heures_total' => $heure_total ,
            'minutes' => intval($minutes) ,
            'minutes_nuit' => intval($minutes_data['nuit']) ,
            'minutes_jour' => intval($minutes_data['jour']) ,
        );
        $return = BlackshFonctions::crenauhoraire($request);


        if($return) {
            $is_update = Planning::where('id', $request->input('planning_id'))->update($data);

            if ($is_update) {

                return back()->with('successupdate','Mise à jour effectuée !');

            }else{

                return back()->with('error','Mise à jour non effectuée !');
            }
        } else {
            return back()->with('error','Cet créneau horaire existe deja   !');
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
        //
    }

    public  function  pdf($id)
    {
        //list($id , $data , $vaccation ) = explode('-',$id);
        /**   FERRIER */
        //recupere le mois en cours et l'année en cours
        $month = Carbon::now()->month;
        $year = strval(Carbon::now()->year);
        //check si des agents existes dans les dates correspondantes
        if ($month == 6) {
            $planningsferies = DB::select('select *, SUM(heure_total_jour) as heure_total_jour, SUM(heure_total_nuit) as heure_total_nuit, 
                            SUM(heures_total) as heures_total,
                             SUM(minutes) as minutes,
                              SUM(minutes_jour) as minutes_jour, 
                              SUM(minutes_nuit) as minutes_nuit 
                              from plannings
                              inner join sites on plannings.site_id = sites.id
                               where site_id = '.$id.' 
                              and (date_debut = "'.$year.'-06-10" or date_debut = "'.$year.'-06-08" or date_debut = "'.$year.'-06-01" or date_debut = "'.$year.'-06-21")');
        }elseif ($month == 1) {
        }elseif ($month == 4) {
        }elseif ($month == 7) {
        }elseif ($month == 8) {
        }elseif ($month == 11) {
        }elseif ($month == 12) {
        }
        /**   FERRIER */

        $site = Site::find($id);

        $plannings = Planning::select(
            DB::raw('*') ,
            DB::raw('agents.nom as nomagent') ,
            DB::raw('agents.prenoms as agentprenoms')
        )
            ->where('site_id', $id)
            ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=', Carbon::now()->endOfMonth())
            ->join('agents',DB::raw('agents.id') , '=' , DB::raw('plannings.agent_id'))
            ->orderBy('date_debut', 'asc')
            ->get();
        $sumhours = Planning::select(DB::raw('SUM(heure_total_jour) as heure_total_jour'),
            DB::raw('SUM(heure_total_nuit) as heure_total_nuit')  ,
            DB::raw('SUM(heures_total) as total')  ,
            DB::raw('SUM(minutes) as minutes') ,
            DB::raw('SUM(minutes_jour) as minutes_jour') ,
            DB::raw('SUM(minutes_nuit) as minutes_nuit')
        )
            ->where('site_id', $id)
            ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
            ->where('date_debut', '<=', Carbon::now()->endOfMonth())
            //->groupBy('agent_id')
            ->orderBy('date_debut', 'asc')
            ->get();
        $pdf    = PDF::loadView('pages.sites.agent-sites-pdf', compact('site', 'plannings', 'sumhours','planningsferies'));

        $pdf->setPaper('A4');
        return $pdf->download('planning -'. $site->nom . "-" . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY')).'.pdf');
        //return view('pages.plannings.pdf.planning-pdf', compact('plannings', 'agent', 'sumhours'));

    }
}
