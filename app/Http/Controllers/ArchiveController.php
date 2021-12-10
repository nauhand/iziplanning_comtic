<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivityHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function insert(Request $request)
    {

        LogActivityHelper::log("Ajout d'un nouveau planning" , 1 , 'plannings',1);
//            if ($request->ajax()) {
        $today=Carbon::today()->toDateTimeString();
        {
            //
            $heures = $this->calcul_heure($request->input('heuredebut'),$request->input('heurefin'));
            $heure_total_jour = $heures[0];
            $heure_total_nuit = $heures[1];
            $total_hours      =  $heures[2];
            $minutes          =  $heures[3];
            $minutes_data      =  $heures[4];
//                    dd($minutes_data);
            $insertion[] = [
                'site_id'=>$request->input('sitename') ,
                'agent_id'=>$request->input('agentid'),
                'date_debut'=>$request->input('datedebut'),
                'pause'=>$request->input('heurepause'),
                'heure_debut'=> $request->input('heuredebut'),
                'heure_fin'=>$request->input('heurefin'),
                'heure_total_jour'=>$heure_total_jour,
                'heure_total_nuit'=>$heure_total_nuit,
                'heures_total' =>intval( $total_hours) ,
                'minutes' => intval($minutes) ,
                'minutes_nuit' => intval($minutes_data['nuit']) ,
                'minutes_jour' => intval($minutes_data['jour']) ,
                'statut'=> 'archives',
                'vacation_id'=> $request->input('vacationid'),
                'created_at'=>$today,
                'updated_at'=>$today
            ];
        }
        DB::table('plannings')->insert($insertion);
//        session()->flash('notification', 'Planning créer avec succès !');
//        return response()->json(['message' => 'success'], 200);
//            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'sitename' => ['required', 'string', 'max:255'],
            'datedebut' => ['required', 'date'],
            'heuredebut' => ['required'],
            'heurefin' => ['required'],
            'heurepause' => ['required'],
        ]);

        $this->insert($request);
        return back()->with('successstore','Nouvelle vacation ajoutée avec succès !');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
