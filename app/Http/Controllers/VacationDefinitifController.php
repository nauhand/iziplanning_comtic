<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Planning;
use App\Models\Agent;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Session;

class VacationDefinitifController extends Controller
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->type == 'archived')
        {
            $statut = "archives";

            $data = array('statut'=>$statut);

            $is_archived = DB::table('plannings')
                            ->where('id', $id)
                            ->where('statut', "definitif")
                            ->update($data);

            if ($is_archived) {

            //Session::flash('success', 'Mise à jour éffectué !');
            return redirect()->route('planning-definitif')->with("success1","La vacation de l'agent est passé en archives !"  );
                
            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectué !');

            }
        }elseif($request->type == 'provisoire')
        {
            $statut = "provisoire";

            $data = array('statut'=>$statut);

            $is_provisoire = DB::table('plannings')
                            ->where('id', $id)
                            ->where('statut', "definitif")
                            ->update($data);

            if ($is_provisoire) {

            //Session::flash('success', 'Mise à jour éffectué !');
            return redirect()->route('planning-definitif')->with("success1","La vacation de l'agent est passée en provisoire !"  );
                
            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectuée !');

            }
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
                    ->where('statut', 'definitif')
                    ->delete();

        if ($is_deleted) {

        //Session::flash('success', 'Mise à jour éffectué !');
        return back()->with("successdelete","La vacation de l'agent à été supprimé avec succès !"  );
            
        }else{

            //Session::flash('error', 'Mise à jour non éffectué !');
            return back()->with('error','Mise à jour non éffectué !');

        }
    }

    public function dataofcrea(Request $request)
    {
            // mise à jour de tout les éléments du tableau
            $var1 = $request->input('id_agent');
            $var2 = $request->input('vacation_id');
            $data = array('statut'=> "archives");
           


            $is_definitif = DB::table('plannings')
                            ->where('statut', 'definitif')
                            ->where('agent_id', $var1)
                            ->where('vacation_id', $var2)
                            ->update($data);

            if ($is_definitif) {

            //Session::flash('success', 'Mise à jour éffectué !');
            return redirect()->route('planning-provisoire')->with('successvacation','Toutes les vacations ont été passés en archives !');
                
            }else{

                //Session::flash('error', 'Mise à jour non éffectué !');
                return back()->with('error','Mise à jour non éffectué !');

            }
        }
}
