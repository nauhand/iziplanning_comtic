<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivityHelper;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Planning;
use App\Models\Agent;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Session;

class VacationProvisoireController extends Controller
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
        $vacation = DB::table('plannings')
                             ->where('id', $id)
                             ->where('statut', "provisoire")->get();
        return response()->json(['success' => true , 'vaccation' => $vacation], 200);
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
        $statut = "definitif";

        $data = array('statut'=>$statut);

        $is_definitif = DB::table('plannings')
                        ->where('id', $id)
                        ->where('statut', "provisoire")
                        ->update($data);


        if ($is_definitif) {

        //Session::flash('success', 'Mise à jour éffectué !');

        LogActivityHelper::log("La vacation de l'agent est passé en définitif !"  , 3 , 'plannings' , 0 );
        return redirect()->route('planning-provisoire')->with("success1","La vacation de l'agent est passé en définitif !"  );
            
        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

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
                    ->where('statut', 'provisoire')
                    ->delete();

        if ($is_deleted) {

        //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log("La vacation de l'agent à été supprimé !"  , 4 , 'plannings' , null );

            return back()->with("successdelete","La vacation de l'agent à été supprimé avec succès !"  );
            
        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }

    public function crea(Request $request)
    {
            // mise à jour de tout les éléments du tableau provisoire
            $var1 = $request->input('id_agent');
            $var2 = $request->input('vacation_id');
            $data = array('statut'=> "definitif");

            $is_definitif = DB::table('plannings')
                            ->where('statut', 'provisoire')
                            ->where('agent_id', $var1)
                            ->where('vacation_id', $var2)
                            ->update($data);

            if ($is_definitif) {

            //Session::flash('success', 'Mise à jour éffectué !');
            LogActivityHelper::log("Toutes les vacations ont été passés en définitifs !"  , 3 , 'plannings' , 0 );
            return redirect()->route('planning-provisoire')->with('successvacation','Toutes les vacations ont été passés en définitifs !');
                
            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectué !');

            }
        }
}
