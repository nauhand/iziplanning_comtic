<?php
//Fonction de planning
    function planningsArray(Request $request){

        $heure_debut = $request->heure_debut;
        $heure_fin = $request->heure_fin;
        
        $test = strtotime($heure_debut);
        $heure_1 = strtotime($heure_fin);
        
        function genereHeure(){
            $test = strtotime('21:00');
            $heure_1 = strtotime('01:00');
            $tableau = [$test];

            while (date('H:i',$test) != date('H:i',strtotime('06:00'))) {
                $tableau[] = end($tableau) +  $heure_1;
                $test += $heure_1;
            }

            return $tableau;
        }

        $tableau = genereHeure();

        foreach ($tableau as $key => $value) {
            $tableau[$key] = date('H', $value);
        }
        
        $heureNuit = 0;
        $heureJour = 0;
        
        while (date('H:i', $test) != date('H:i', $heure_1)) {

            if (array_search(date('H',$test), $tableau)) {
                $heureNuit++;
            }else{
                $heureJour++;
            }
            $test += strtotime('01:00');

        }
        // Les entiers à utiliser sont {heureNuit et heureJour}


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

            $plannings[$i]['heure_total_jour']=$heureJour;
            $plannings[$i]['heure_total_nuit']=$heureNuit;

            $plannings[$i]['statut']='provisoire';
            $today=Carbon::now()->toDateTimeString();
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
