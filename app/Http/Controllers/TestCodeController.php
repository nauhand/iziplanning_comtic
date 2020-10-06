<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calcule_minute($heure_debut, $heure_fin) {
            $tableau = [ "test" ,"21","22","23","00","01","02","03","04","05","06"];
            if(!array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
                return  ['jour' => (int)explode(':',$heure_debut)[1] + (int)explode(':',$heure_fin)[1] , 'nuit' => 0 ];
            }
            elseif(!array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
                return  ['jour' => (int)explode(':',$heure_debut)[1]  , 'nuit' =>  (int)explode(':',$heure_fin)[1] ];
            } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && !array_search(date('H',strtotime($heure_fin)), $tableau)) {
                return  ['jour' => (int)explode(':',$heure_fin)[1]  , 'nuit' =>  (int)explode(':',$heure_debut)[1] ];
            } elseif(array_search(date('H',strtotime($heure_debut)), $tableau) && array_search(date('H',strtotime($heure_fin)), $tableau)) {
                return  ['nuit' => (int)explode(':',$heure_debut)[1] + (int)explode(':',$heure_fin)[1] , 'jour' => 0 ];
            }
        }
        public function calcul_heure($heure_debut, $heure_fin){
            $test = strtotime($heure_debut);
            $heure_1 = strtotime($heure_fin);
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
            $minutes = $this->calcule_minute($heure_debut,$heure_fin);
            return [$heureJour, $heureNuit , $minutes];
        }

    public function index()
    {
        $heure_debut = "21:30";
        $heure_fin = "12:00";
        $minutes = $this->calcul_heure($heure_debut,$heure_fin);

        dd($minutes); die();
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
