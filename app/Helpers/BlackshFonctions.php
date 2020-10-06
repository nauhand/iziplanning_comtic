<?php

namespace App\Helpers;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class BlackshFonctions
{
    public static function arrayToString($array=[]){
        $string='';

        if(is_null($array))
            return '';

        foreach ($array as $value) {
            $string.=$value.',';
        }
        return $string;
    }

    public static function qualificationString(Request $request){
        $qualification='';
        if($request->ads==='on'){
            $qualification.='ads,';
        }
        if($request->maitrechien==='on'){
            $qualification.='maitrechien,';
        }
        if($request->ssiap1==='on'){
            $qualification.='ssiap1,';
        }
        if($request->ssiap2==='on'){
            $qualification.='ssiap2,';
        }
        if($request->chefequipe==='on'){
            $qualification.='chefequipe,';
        }
        if($request->superviseur==='on'){
            $qualification.='superviseur,';
        }
        if($request->commercial==='on'){
            $qualification.='commercial,';
        }
        if($request->agentcontrole==='on'){
            $qualification.='agentcontrole,';
        }
        if ($request->assitanceRh=='on') {
            $qualification.="Assistance RH";
        }
        if ($request->responsableRh=='on') {
            $qualification.="Responsable RH";
        }
        if ($request->comptable_assistant=='on') {
            $qualification.="Assistance comptable ";
        }
        if ($request->comptable=='on') {
            $qualification.="comptable ";
        }
        if ($request->comptable_expert=='on') {
            $qualification.="Expert Comptable ";
        }

        return $qualification;
    }

    public static function upload(Request $request){
        $file=$request->file('photo');

        if(is_null($file))
            return '';

        // $filename=$file->getClientOriginalName();
        $fileExtension=$file->getClientOriginalExtension();
        $filename=Str::slug($request->nom).'.'.$fileExtension;

        $path=$request->file('photo')->move(public_path('uploads/img/sites'),$filename);
        // $photoUrl=url('/'.$filename);
        $photoUrl='uploads/img/sites/'.$filename;

        return $photoUrl;
    }

    public static function format($time) {
        list($h,$m,$s) = explode(':',$time);
        $h = strlen($h) >= 2 ? $h : '0'.$h ;
        $m = strlen($m) >= 2 ? $m : '0'.$m ;
        $s = strlen($s) >= 2 ? $s : '0'.$s ;
        //     dd($h.':'.$m.':'.$s);
        return $h.':'.$m.':'.$s ;
    }

    private static function gettranche($startTime, $endTime, $duration="60"){

        $ReturnArray = array ();
        $StartTime    = strtotime ($startTime); // Timestamp
        $EndTime      = strtotime ($endTime); // Timestamp


        $AddMins  = intval($duration) * 60;

        while ($StartTime <= $EndTime)
        {
            $ReturnArray[] = date ("G:i", $StartTime);
            $StartTime += $AddMins;
        }
        return $ReturnArray;
    }

    /* ------------------------ CALCUL HEURE -------------------------------------*/
    public static function crenauhoraire(Request $request)
    {
        $id_agent = $request->agentid ;
        $heuredebut = $request->heuredebut ;
        $datedebut = $request->datedebut ;
        $heurefin = $request->heurefin ;

        $agent = Planning::where('date_debut',$datedebut)->where('agent_id',$id_agent)->count();

        if($agent != 0) {
            $planning = Planning::where('date_debut',$datedebut)->where('agent_id',$id_agent)->get()[0];

            $tableau [0]=  'test' ;

            $heure_debut = $planning->heure_debut  ;
            $heure_fin   = $planning->heure_fin ;

            $test = strtotime($heure_debut);
            $heure_1 = strtotime($heure_fin);

            while (date('H', $test) != date('H', $heure_1)) {
                $tableau[] = strval(date('H', $test)) ;
                $test += strtotime('01:00');
            }

            if(!array_search(date('H',strtotime($heuredebut)), $tableau) && !array_search(date('H',strtotime($heurefin)), $tableau)) {
                return  true ;
            }
            elseif(!array_search(date('H',strtotime($heuredebut)), $tableau) && array_search(date('H',strtotime($heurefin)), $tableau)) {
                return  false ;
            } elseif(array_search(date('H',strtotime($heuredebut)), $tableau) && !array_search(date('H',strtotime($heurefin)), $tableau)) {
                 return  false ;
            } elseif(array_search(date('H',strtotime($heuredebut)), $tableau) && array_search(date('H',strtotime($heurefin)), $tableau)) {
                return  false ;
            }
        }else {
            return true ;
        }
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

     }