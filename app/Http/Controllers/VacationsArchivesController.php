<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Planning;
use DB;
use Session;
Use Carbon\Carbon;
use Illuminate\Support\Str;

class VacationsArchivesController extends Controller
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

    public function calcul_heure($heure_debut, $heure_fin){
        
        $test = strtotime($heure_debut);
        $heure_1 = strtotime($heure_fin);
        $minute = 0;

        // $tableau = $this->genereHeure();
        // $tableau = [1585861200, 3171650400,4757439600,6343228800,7929018000,9514807200,11100596400,12686385600,14272174800,15857964000];

        $tableau = ["21","22","23","00","01","02","03","04","05","06"];

        // foreach ($tableau as $key => $value) {
        //     $tableau[$key] = date('H', $value);
        // }

        $heureNuit = 0;
        $heureJour = 0;

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
        return [$heureJour+$minute, $heureNuit];
        
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
        $heuredebut = $request->input('heuredebut');
        $heurefin = $request->input('heurefin');
        $heurepause = $request->input('heurepause');

        // récupération du nombre d'heure de jour et de nuit

        $heures = $this->calcul_heure($heuredebut, $heurefin);
        $heure_total_jour = $heures[0];
        $heure_total_nuit = $heures[1];

        //dd($heure_total_nuit); die();

        $data = array('site_id'=>$sitename,
                 'heure_debut'=>$heuredebut,
                  'heure_fin'=>$heurefin,
                   'pause'=>$heurepause,
                    'heure_total_jour'=>$heure_total_jour,
                    'heure_total_nuit'=>$heure_total_nuit);

        $is_update = Planning::where('id', $request->input('planning_id'))->update($data);

        if ($is_update) {

            return back()->with('successupdate','Mise à jour éffectuée !');
            
        }else{

            return back()->with('error','Mise à jour non éffectuée !');
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
        $is_deleted = DB::table('plannings')
                    ->where('id', $id)
                    ->where('statut', 'archives')
                    ->delete();

        if ($is_deleted) {

        //Session::flash('success', 'Mise à jour éffectué !');
        return back()->with("successdelete","La vacation de l'agent à été supprimé avec succès !"  );
            
        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }
}
