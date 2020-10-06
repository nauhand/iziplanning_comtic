<?php

namespace App\Http\Controllers;

use App\Exports\AbsencesExcel;
use App\Exports\AgentExcel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Agent;
use App\Models\Conge;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;


use App\Helpers\LogActivityHelper;


class AbsencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $absences = Conge::where('date_debut', '<=', Carbon::today())
        // -> where('date_fin', '>=',Carbon::today())
        // -> orderBy('updated_at', 'desc')
        // -> get();

        $absences = Conge::where('date_debut', '>=', Carbon::today())
            ->orderBy('updated_at', 'desc')
            ->get();
        // dd($absences);
        // dd($request);

        // if($request->ajax()){
        //     return response()->json(['content'=>view('pages.absences.index',compact('absences'))->renderSections()['content']],200);
        // }
        return view('pages.absences.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        return view('pages.absences.create', compact('agents'));
    }

    public function ajout()
    {
        $agents = Agent::all();
        return view('pages.absences.add', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validationConge($request);
        if ($v->fails()) {
            if ($request->ajax()) {
                return response()->json($v->errors(), 422);
            }
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        Conge::create([
            'agent_id' => $request->agent,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
        ]);

        // LogActivityHelper::log('')
        return redirect()->back();
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
        $absence_updated = Conge::where('id', $id)->firstOrFail();
        return view('pages.absences.updated', compact('absence_updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $v = $this->validationConge(request()->all());

        if ($v->fails()) {

            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }

        $absence = Conge::where('id', $id)->firstOrFail();

        $absence->update([
            'typeconge' => request('typeconge'),
            'date_debut' => request('date_debut'),
            'date_fin' => request('date_fin'),
            'motif' => request('motif'),
        ]);


        LogActivityHelper::log("Mise a jour d'un congé ", 2 , 'conges' , $absence->id);
        return redirect()->route('absence.index')->with('success','La mise à jour a été effectué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $absence = Conge::where('id', $id)->firstOrFail();
            
        $result = $absence->delete();
        LogActivityHelper::log("Suppression d'un congé ", 3 , 'conges' , $absence->id);
        $absences = Conge::where('date_debut', '<=', Carbon::today())
            ->where('date_fin', '>=', Carbon::today())
            ->orderBy('updated_at', 'desc')->get();

//        $new_content = view('pages.absences.table', compact('absences'))->render();
            return  back()->with('success', 'Suppression effectuée');
//        if ($result) {
//            return response()->json(['statut' => 'succes', 'msg' => 'Planning Supprimé', 'new_content' => $new_content], 200);
//        } else {
//            return response()->json(['statut' => 'echec', 'msg' => 'Erreur, veuillez réessayer svp !', 'new_content' => $new_content], 422);
//        }
    }

    public function validationConge()
    {
        $v = Validator::make(request()->all(), [
            'agent' => 'required|exists:agents,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);
        $request = request()->all();
        $v->sometimes('motif', 'required|min:2|string', function ($input) use ($request) {
            return !is_null(request('motif'));
        });

        return $v;
    }

    public  function pdfs() {
        // return view('pages/agents/agentinfo',compact('agent'));
        $absences = Conge::where('date_debut', '>=', \Illuminate\Support\Carbon::today())
            ->orderBy('updated_at', 'desc')
            ->get();
        $pdf = PDF::loadView('pages/pdf/agentAbsent', compact('absences'));
        // $pdf->setPaper('A4', 'landscape');
        $name = "absence-". Carbon::now(). ".pdf";

        //dd($agent); die();
        return $pdf->download($name);
    }

    public function excels() {
        $titre = 'absence' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new AbsencesExcel(  ), $titre . '.xlsx');
    }
}
