<?php

namespace App\Http\Controllers;

use App\Exports\AgentExcel;
use App\Exports\SiteAllExcel;
use App\Models\Agent;
use Validator;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Helpers\BlackshFonctions;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogActivityHelper;
use Maatwebsite\Excel\Facades\Excel;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sites = Site::select(DB::raw('*'))
                ->orderBy('nom', 'asc')
                ->get();

        $sitesListe = Site::select(DB::raw('*'))
                ->orderBy('nom', 'asc')
                ->get();


        if($request->ajax()){
            if ($request->id) {

                $sites = Site::select(DB::raw('*'))
                    ->where('id', $request->id)
                    ->orderBy('nom', 'asc')
                    ->get();
                return response()->json(['content'=>view('pages.sites.tableSearch',compact('sites', 'sitesListe'))->renderSections()['content']],200);

            }

            $sites = Site::where('nom', 'LIKE', '%'. $request->nameSite .'%')
                    ->orderBy('nom', 'asc')
                    ->get();
                    $name =  $request->nameSite ;
            return response()->json(['content'=>view('pages.sites.tableSearch',compact('sites', 'sitesListe', 'name'))->renderSections()['content']],200);
        }
        return view('pages.sites.index',compact('sites', 'sitesListe'));
    }
    // public function index(Request $request)
    // {
    //     $sites=Site::all();


    //     if($request->ajax()){
    //         return response()->json(['content'=>view('pages.sites.index',compact('sites'))->renderSections()['content']],200);
    //     }
        
    //     return view('pages.sites.index',compact('sites'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            return response()->json(['content'=>view('pages.sites.create')->renderSections()['content']],200);
        }
        return view('pages.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation de données
        $v=$this->validationsSite($request);

        if($v->fails()){
          return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        //Enrégistrements des informations
        $id = DB::table('sites')->insertGetId([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'ville' => $request->ville,
            'telephone' => $request->telephone,
            'site_web' => $request->site_web,
            'photo' => BlackshFonctions::upload($request),
            'nommanager' => $request->nommanager,
            'telephonemanager' => $request->telephonemanager,
            'site_couleur' => $request->site_couleur
        ]);
        LogActivityHelper::log("Ajout d'un site ", 1 , 'sites' , $id);
//        session()->flash('notification', 'Site ajouté avec succès');
        return redirect()->route('site.index')->with('success','Site ajouté avec succès');
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
    public function search_site(Request $request)
    {
        $word=$request->word;
        $sites =Site::where(function($query) use ($word) {
            return $query->Where('nom','LIKE','%'.$word.'%')
            ->orWhere('ville','LIKE','%'.$word.'%')
            ->orWhere('telephone','LIKE','%'.$word.'%');
        })
        ->paginate(20);
        $view=view('pages.sites.table',compact('sites'))->render();

        return response()->json(['statut'=>'succes','content'=>$view],200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $site=Site::where('id',$id)->firstOrFail();

        if($request->ajax()){
            return response()->json(['content'=>view('pages.sites.edit',compact('site'))->renderSections()['content']],200);
        }
        return view('pages.sites.edit',compact('site'));
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
        // dd(BlackshFonctions::upload($request));
        // dd($request->all());
        $site=Site::where('id',$id)->firstOrFail();
        //Validation de données
        $v=$this->validationsSite($request);

        if($v->fails()){
          return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        if(is_null($request->photo))
            $photo=$site->photo;
        else
            $photo=BlackshFonctions::upload($request);
        //Enrégistrements des informations
        $site->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'ville' => $request->ville,
            'telephone' => $request->telephone,
            'site_web' => $request->site_web,
            'photo' => $photo,
            'nommanager' => $request->nommanager,
            'telephonemanager' => $request->telephonemanager,
            'site_couleur' => $request->site_couleur,
        ]);

        LogActivityHelper::log("Mise a jout d'un site ", 2 , 'sites' , $site->id);
        return redirect()->route('site.index')->with('success','Mise à jour effectué');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site=Site::where('id',$id)->firstOrFail();
        LogActivityHelper::log("Suppression  d'un site ", 3 , 'sites' , $id);
        $result=$site->delete();
        return redirect()->route('site.index')->with('success','Suppression effectué');
//        $sites=Site::all();
//        $new_content=view('pages.sites.table',compact('sites'))->render();
//
//        if($result){
//            return response()->json(['statut'=>'succes','msg'=>'Planning Supprimé','new_content'=>$new_content],200);
//        }
//        else{
//            return response()->json(['statut'=>'echec','msg'=>'Erreur, veuillez réessayer svp !','new_content'=>$new_content],422);
//        }
    }
    //fonction validation de données
    public function validationsSite(Request $request){
        $v=Validator::make($request->all(),[
            'nom' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
        ]);

        // $v->sometimes('photo',['required','mimes:jpg,png'],function($input) use ($request){
        //     return !is_null($request->photo);
        // });

        $v->sometimes('telephone',['required','numeric','min:2'],function($input) use ($request){
            return !is_null($request->telephone);
        });

        $v->sometimes('nommanager',['required','min:2'],function($input) use ($request){
            return !is_null($request->nommanager);
        });

        $v->sometimes('telephonemanager',['required','numeric','min:2'],function($input) use ($request){
            return !is_null($request->telephonemanager);
        });

        return $v;  
    }

    public  function excelAllSite() {

        $titre ='sites-excel' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new SiteAllExcel(), $titre . '.xlsx');
    }
}
