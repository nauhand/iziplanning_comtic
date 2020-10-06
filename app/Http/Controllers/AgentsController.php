<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Validator;
use App\Models\Agent;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\BlackshFonctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDF;
use App\Exports\AgentExcel;
use Maatwebsite\Excel\Facades\Excel;

use App\Helpers\LogActivityHelper;
class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agents = Agent::select(DB::raw('*'))
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        $agentsList = Agent::all();

        if($request->ajax()){
            if ($request->id) {

                $agents = Agent::select(DB::raw('*'))
                    ->where('id', $request->id)
                    ->orderBy('nom', 'asc')
                    ->get();
                return response()->json(['content'=>view('pages.agents.tableSearch',compact('agents'))->renderSections()['content']],200);

            }

            $agents = Agent::where('nom', 'LIKE', '%'.$request->nameAgent.'%')
                    ->orWhere('prenoms', 'LIKE', '%'.$request->nameAgent.'%')
                    ->orderBy('nom', 'asc')
                    ->get();
            return response()->json(['content'=>view('pages.agents.tableSearch',compact('agents'))->renderSections()['content']],200);
        }
        
        return view('pages.agents.index',compact('agents', 'agentsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create')->renderSections()['content']],200);
        }

        return view('pages.agents.create2');
    }

    public function createStepOne(Request $request)
    {
        //Créer la variable user
        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');

        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create.create-step-one',compact('agent'))->renderSections()['content']],200);
        }
        
        // return view('pages.agents.create.create',compact('agent', $agent));
        return view('pages.agents.create.create-step-one',compact('agent', $agent));
    }

    public function createStepTwo(Request $request)
    {
        //Si la variable session n'existe alors rediriger a la premiere etape
        if(is_null($request->session()->get('agent'))){
          return redirect()->route('agent.createStepOne');
        }

        $agent = $request->session()->get('agent');
        $departements = Departement::all();
        
        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create.create-step-two',compact('agent','departements'))->renderSections()['content']],200);
        }
        return view('pages.agents.create.create-step-two',compact('agent', 'departements'));
    }

    public function createStepThree(Request $request)
    {
        //Si la variable session n'existe alors rediriger a la premiere etape
        if(is_null($request->session()->get('agent'))){
          return redirect()->route('agent.createStepOne');
        }

        $agent = $request->session()->get('agent');
        
        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create.create-step-three',compact('agent'))->renderSections()['content']],200);
        }
        return view('pages.agents.create.create-step-three',compact('agent', $agent));
    }

    public function createStepFour(Request $request)
    {
        //Si la variable session n'existe alors rediriger a la premiere etape
        if(is_null($request->session()->get('agent'))){
          return redirect()->route('agent.createStepOne');
        }

        $agent = $request->session()->get('agent');
        
        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create.create-step-four',compact('agent'))->renderSections()['content']],200);
        }
        return view('pages.agents.create.create-step-file',compact('agent', $agent));
    }

    public function createStepFile(Request $request)
    {
        //Si la variable session n'existe alors rediriger a la premiere etape
        if(is_null($request->session()->get('agent'))){
          return redirect()->route('agent.createStepOne');
        }

        $agent = $request->session()->get('agent');
        
        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.create.create-step-file',compact('agent'))->renderSections()['content']],200);
        }
        return view('pages.agents.create.create-step-file',compact('agent', $agent));
    }

    public function postStepOne(Request $request)
    {
       
        $validatedData = Validator::make($request->all(),[
            'civilite'=> [
                'required',
                  Rule::in(['M', 'Mll','Mme']),
            ],
            'statutmatrimonial'=> [
                  'required',
                  Rule::in(['mar', 'cel','veuf']),
              ],
            'nom' => 'required|min:2',
            'datenaissance' => 'required|date|before:'.Carbon::now()->addYear(-18)->format('d-m-Y'),
            'prenoms' => 'required',
        ]);
        
        if($validatedData->fails()){
            if ($request->ajax()) {
                return response()->json($validatedData->errors(),422);
            }
          return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $validatedData=$validatedData->validate();
        //Ajouter les champs non obligatoire
        $matricule=strtoupper(substr($request->nom, 0, 3).substr($request->prenoms, 0, 3).Carbon::now()->format('dmy'));
        $validatedData['matricule']=$matricule;

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }
        // dd($agent);
        return redirect()->route('agent.createStepTwo');
    }

    public function postStepTwo(Request $request)
    {
        //Validation de données
        $validatedData=Validator::make($request->all(),[
            'numeromobile' => 'required|numeric|digits:13',
        ]);
        //Validation
        $validatedData->sometimes('numerofixe','required|numeric|digits:13', function ($input) use ($request) {
            return !is_null($request->numerofixe);
        });
        $validatedData->sometimes('email','required|email', function ($input) use ($request) {
            return !is_null($request->email);
        });

        if($validatedData->fails()){
            if ($request->ajax()) {    
                return response()->json($validatedData->errors(),422);
            }
          return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $validatedData=$validatedData->validate();

        //Ajouter les champs non obligatoire
        $validatedData['numeromobile']=$request->numeromobile;
        $validatedData['email']=$request->email;
        $validatedData['codepostal']=$request->codepostal;
        $validatedData['adressegeo']=$request->adressegeo;
        $validatedData['numerofixe']=$request->numerofixe;
        $validatedData['departement_id']=$request->departement;

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }

        return redirect()->route('agent.createStepThree');
    }

    public function postStepThree(Request $request)
    {
        //Validation de données
        $validatedData=Validator::make($request->all(),[
            'nationalite'=> [
                  'required',
                  Rule::in(['FR', 'ET']),
            ]
        ]);
        //Validation
        $validatedData->sometimes('numerocni','required|min:5', function ($input) use ($request) {
            return $request->nationalite==='FR';
        });

        //Validation si la nationalité est étrangère
        $validatedData->sometimes('numeroetranger','required|min:5', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $validatedData->sometimes('lieudelivrancecs','required|min:5', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $validatedData->sometimes('etablissementcartedesejour','required|date', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $validatedData->sometimes('expirationcartedesejour','required|date', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });
        //Validation si le permis est saisie
        $validatedData->sometimes(['dateetablpermis','dateexpirpermis'],'required|date', function ($input) use ($request) {
            return !is_null($request->numeropermis);
        });
        $validatedData->sometimes('lieudelivrancepermis','required', function ($input) use ($request) {
            return !is_null($request->numeropermis);
        });
        // $validatedData->sometimes('categoriepermis',['required',Rule::in(['AM','A','A1','A2','B','B1','BE','C','C1','CE','C1E','D','D1','DE','D1E'])], function ($input) use ($request) {
        //     return !is_null($request->numeropermis);
        // });

        if($validatedData->fails()){
            if ($request->ajax()) {    
                return response()->json($validatedData->errors(),422);
            }
          return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $validatedData=$validatedData->validate();
        //Recupération de la catégorie sous forme de chaine
        $categoriepermis=BlackshFonctions::arrayToString($request->categoriepermis);
        $validatedData['numeropermis']=$request->numeropermis;
        $validatedData['lieudelivrancepermis']=$request->lieudelivrancepermis;
        $validatedData['dateetablpermis']=$request->dateetablpermis;
        $validatedData['dateexpirpermis']=$request->dateexpirpermis;
        $validatedData['categoriepermis']=$categoriepermis;

        $validatedData['numeross']=$request->numeross;

        if($request->nationalite=='FR'){
          $validatedData['numerocni']=$request->numerocni;

          $validatedData['numeroetranger']=null;
          $validatedData['lieudelivrancecs']=null;
          $validatedData['etablissementcartedesejour']=null;
          $validatedData['expirationcartedesejour']=null;
        }else{
          $validatedData['numerocni']=null;

          $validatedData['numeroetranger']=$request->numeroetranger;
          $validatedData['lieudelivrancecs']=$request->lieudelivrancecs;
          $validatedData['etablissementcartedesejour']=$request->etablissementcartedesejour;
          $validatedData['expirationcartedesejour']=$request->expirationcartedesejour;
        }

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }

        return redirect()->route('agent.createStepFour');
    }

    public function postStepFour(Request $request)
    {
        //Validation de données
        $validatedData=Validator::make($request->all(),[
            'typecontrat'=> [
                  'required',
                  Rule::in(['cdi', 'cdd','interim','essai']),
            ]
        ]);

        //Validation de la durée du contrat si ce n'est pas un cdi
        $validatedData->sometimes('dureeducontrat','required', function ($input) use ($request) {
            return $request->typecontrat!='cdi';
        });
        //Validation si ADS est coché
        $validatedData->sometimes('numeroads','required|min:5', function ($input) use ($request) {
            return $request->ads==='on';
        });
        //Validation si maitre chien est coché
        $validatedData->sometimes('nomchien','required|min:2', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });
        $validatedData->sometimes('datevaliditevaccin','required|date', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });

        if($validatedData->fails()){
            if ($request->ajax()) {    
                return response()->json($validatedData->errors(),422);
            }
          return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $validatedData=$validatedData->validate();
        //Ajouter les autres champs
        if($request->typecontrat=='cdi'){
          $validatedData['dureeducontrat']=null;
        }else{
          $validatedData['dureeducontrat']=$request->dureeducontrat;
        }

        if($request->ads!='on'){
          $validatedData['numeroads']=null;
        }else{
          $validatedData['numeroads']=$request->numeroads;
        }

        if($request->maitrechien!='on'){
          $validatedData['nomchien']=null;
          $validatedData['datevaliditevaccin']=null;
        }else{
          $validatedData['nomchien']=$request->nomchien;
          $validatedData['datevaliditevaccin']=$request->datevaliditevaccin;
        }

        if ($request->maitrechien=='on') {
            $validatedData['qualification']='Maître chien';
        }
        if ($request->ads=='on') {
            $validatedData['qualification']='ADS';
        }
        if ($request->ssiap1=='on') {
            $validatedData['qualification']='SSIAP1';
        }
        if ($request->ssiap2=='on') {
            $validatedData['qualification']='SSIAP2';
        }
        if ($request->chefequipe=='on') {
            $validatedData['qualification']="Chef d'équipe";
        }
        if ($request->superviseur=='on') {
            $validatedData['qualification']="Superviseur";
        }
        if ($request->commercial=='on') {
            $validatedData['qualification']="Commercial";
        }
        if ($request->agentcontrole=='on') {
            $validatedData['qualification']="Agentcontrole";
        }

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }
        // dd($agent);
        //Creation de l'agent
        return redirect()->route('agent.createStepFile');


        if($agent->save()){
          //agent créer avec succes
          $request->session()->forget('agent');        
          return redirect()->route('agent.createStepOne');
        }else{
          return redirect()->route('agent.createStepOne');
        }

        return redirect()->route('agent.createStepFile');
    }

    public function postStepFile(Request $request)
    {
        //Validation de données
        // titre_sejour
        // titre_sejour_verso
        // carte_vitale
        // carte_vitale_verso
        // permis_conduire
        // permis_conduire_verso
        // piece_identite
        // piece_identite_verso
        // passport
        // passport_verso
        // carte_nationale
        // carte_nationale_verso
        $validatedData=Validator::make($request->all(),[
            'piece_identite' => 'required|file'
        ]);

        if($validatedData->fails()){

            if ($request->ajax()) {    
                return response()->json($validatedData->errors()->all(),422);
                // return response()->json($validatedData->errors(),200);
            }

            return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
        }

        // $validatedData=Validator::make($request->all(),[
        //     'piece_identite'=> 'required',
        // ]);

        return redirect()->route('agent.createStepFour');
        
        //Validation si ADS est coché
        $validatedData->sometimes('titre_sejour_verso','required|image', function ($input) use ($request) {
            return !is_null($request->titre_sejour);
        });
        return redirect()->route('agent.createStepFour');
        //Validation de la durée du contrat si ce n'est pas un cdi
        $validatedData->sometimes('dureeducontrat',['required',Rule::in(['3mois', '6mois','1ans','2ans'])], function ($input) use ($request) {
            return $request->typecontrat!='cdi';
        });

        $validatedData->sometimes('titre_sejour_verso','required|image', function ($input) use ($request) {
            return !is_null($request->titre_sejour);
        });
        //Validation si maitre chien est coché
        $validatedData->sometimes('nomchien','required|min:2', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });
        $validatedData->sometimes('datevaliditevaccin','required|date', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });

        if($validatedData->fails()){
            if ($request->ajax()) {    
                return response()->json($validatedData->errors(),422);
            }
          return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $validatedData=$validatedData->validate();
        //Ajouter les autres champs
        if($request->typecontrat=='cdi'){
          $validatedData['dureeducontrat']=null;
        }else{
          $validatedData['dureeducontrat']=$request->dureeducontrat;
        }

        if($request->ads!='on'){
          $validatedData['numeroads']=null;
        }else{
          $validatedData['numeroads']=$request->numeroads;
        }

        if($request->maitrechien!='on'){
          $validatedData['nomchien']=null;
          $validatedData['datevaliditevaccin']=null;
        }else{
          $validatedData['nomchien']=$request->nomchien;
          $validatedData['datevaliditevaccin']=$request->datevaliditevaccin;
        }

        if ($request->maitrechien=='on') {
            $validatedData['qualification']='Maître chien';
        }
        if ($request->ads=='on') {
            $validatedData['qualification']='ADS';
        }
        if ($request->ssiap1=='on') {
            $validatedData['qualification']='SSIAP1';
        }
        if ($request->ssiap2=='on') {
            $validatedData['qualification']='SSIAP2';
        }
        if ($request->chefequipe=='on') {
            $validatedData['qualification']="Chef d'équipe";
        }
        if ($request->superviseur=='on') {
            $validatedData['qualification']="Superviseur";
        }
        if ($request->commercial=='on') {
            $validatedData['qualification']="Commercial";
        }
        if ($request->agentcontrole=='on') {
            $validatedData['qualification']="Agentcontrole";
        }

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }
        // dd($agent);
        //Creation de l'agent
        if($agent->save()){
          //agent créer avec succes
          $request->session()->forget('agent');        
          return redirect()->route('agent.createStepOne');
        }else{
          return redirect()->route('agent.createStepOne');
        }

        return redirect()->route('agent.createStepOne');
    }
    /**Abdoul */

    public function createForm1(Request $request) 
    {
        // $request->session()->forget('agent');
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.form_1.form_1', compact('agent', 'departements'));
    }

    public function postCreate1(Request $request) 
    {
        $validatedData = Validator::make($request->all(),[
            'civilite'=> [
                'required',
                  Rule::in(['M', 'Mll','Mme']),
            ],
            'statutmatrimonial'=> [
                  'required',
                  Rule::in(['mar', 'cel','veuf']),
              ],
            'nom' => 'required|min:2',
            'datenaissance' => 'required|date|before:'.Carbon::now()->addYear(-18)->format('d-m-Y'),
            'prenoms' => 'required',
            'adressegeo' => 'required|min:3'
        ]);

        if ($validatedData->fails()) {
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $validatedData= $validatedData->validate();
        $matricule = mb_strtoupper(substr($request->nom, 0, 3).substr($request->prenoms, 0, 3).Carbon::now()->format('dmy'));
        $validatedData['matricule'] = $matricule;

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }
        // dd($agent);
        return redirect()->route('agent.step.2');
    }

    public function createForm2(Request $request) 
    {
        if(is_null($request->session()->get('agent'))){
            return redirect()->route('agent.step.1');
          }
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.form_1.form_2', compact('agent', 'departements'));
    }

    public function postCreate2(Request $request) 
    {
        
        
        // $validatedData = Validator::make($request->all(),[
        //     'numeromobile' => [
        //         'required',
        //         'numeric' ,
        //         'digits:13'
        //     ],
        //     'numerofixe' => [
        //         'required' ,
        //         'numeric' ,
        //         'digits:13'
        //     ],
        //     'email' => [
        //         'required', 
        //         'email'
        //     ],
        //     'ville' =>  [
        //         'required',
        //         'min:3'
        //     ],
        //     'departement_id' => [
        //         'required'
        //     ]
        // ]);
        // if($validatedData->fails()){
        //     return redirect()
        //     ->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }
        // $validatedData= $validatedData->validate();
        // $validatedData['numeromobile']=$request->numeromobile;
        // $validatedData['email']=$request->email;
        // $validatedData['codepostal']=$request->codepostal;
        // $validatedData['adressegeo']=$request->adressegeo;
        // $validatedData['numerofixe']=$request->numerofixe;
        // $validatedData['departement_id']=$request->departement;
        // $validatedData['ville']=$request->ville;

        // if(empty($request->session()->get('agent'))){
        //     $agent = new Agent();
        //     $agent->fill($validatedData);
        //     $request->session()->put('agent', $agent);
        // }else{
        //     $agent = $request->session()->get('agent');
        //     $agent->fill($validatedData);
        //     $request->session()->put('agent', $agent);
        // }

        return redirect()->route('agent.step.3');
    }


    public function createForm3(Request $request) 
    {
        
        if(is_null($request->session()->get('agent'))){
            return redirect()->route('agent.step.1');
          }
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.form_1.form_3', compact('agent', 'departements'));
    }
    public function postCreate3(Request $request) 
    {
       
        // $validatedData=Validator::make($request->all(),[
        //     'nationalite'=> [
        //           'required',
        //           Rule::in(['FR', 'ET']),
        //     ]
        // ]);
        
        // $validatedData->sometimes('numerocni','required|min:5', function ($input) use ($request) {
        //     return $request->nationalite==='FR';
        // });
        
        // $validatedData->sometimes('numeroetranger','required|min:5', function ($input) use ($request) {
        //     return $request->nationalite==='ET';
        // });
        
        // $validatedData->sometimes('lieudelivrancecs','required|min:5', function ($input) use ($request) {
        //     return $request->nationalite==='ET';
        // });

        // $validatedData->sometimes('etablissementcartedesejour','required|date', function ($input) use ($request) {
        //     return $request->nationalite==='ET';
        // });

        // $validatedData->sometimes('expirationcartedesejour','required|date', function ($input) use ($request) {
        //     return $request->nationalite==='ET';
        // });
        
        // $validatedData->sometimes(['dateetablpermis','dateexpirpermis'],'required|date', function ($input) use ($request) {
        //     return !is_null($request->numeropermis);
        // });

        // $validatedData->sometimes('lieudelivrancepermis','required', function ($input) use ($request) {
        //     return !is_null($request->numeropermis);
        // });

        // if ($request->ajax()) {
        //     return redirect()
        //             ->back()
        //             ->withErrors($validatedData)
        //             ->withInput();
        //   }


        // $validatedData= $validatedData->validate();
        // $categoriepermis=BlackshFonctions::arrayToString($request->categoriepermis);
        // $validatedData['numeropermis'] = $request->numeropermis;
        // $validatedData['lieudelivrancepermis'] = $request->lieudelivrancepermis;
        // $validatedData['dateetablpermis'] = $request->dateetablpermis;
        // $validatedData['dateexpirpermis'] = $request->dateexpirpermis;
        // $validatedData['categoriepermis'] = $categoriepermis;


        // $validatedData['numeross']=$request->numeross;
        // $validatedData['numerocaf']=$request->caf;


        // if($request->nationalite=='FR'){

        //     $validatedData['numerocni']=$request->numerocni;
        //     $validatedData['numeroetranger']=null;
        //     $validatedData['lieudelivrancecs']=null;
        //     $validatedData['etablissementcartedesejour']=null;
        //     $validatedData['expirationcartedesejour']=null;
            
        //   }else{

        //     $validatedData['numerocni']=null;
        //     $validatedData['numeroetranger']=$request->numeroetranger;
        //     $validatedData['lieudelivrancecs']=$request->lieudelivrancecs;
        //     $validatedData['etablissementcartedesejour']=$request->etablissementcartedesejour;
        //     $validatedData['expirationcartedesejour']=$request->expirationcartedesejour;

        //   }

        //   if(empty($request->session()->get('agent'))){
        //     $agent = new Agent();
        //     $agent->fill($validatedData);
        //     $request->session()->put('agent', $agent);
        // }else{
        //     $agent = $request->session()->get('agent');
        //     $agent->fill($validatedData);
        //     $request->session()->put('agent', $agent);
        // }

        return redirect()->route('agent.step.4');


    }
    
    public function createForm4(Request $request) 
    {
        
        if(is_null($request->session()->get('agent'))){
            return redirect()->route('agent.step.1');
          }
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.form_1.form_4', compact('agent', 'departements'));
    }



    
 

    public function postCreate4(Request $request) 
    {

       
        $validatedData=Validator::make($request->all(),[
            'typecontrat'=> [
                'required',
                Rule::in(['cdi', 'cdd','interim','essai']),
            ] , 
            'dateentree' => 'required|date' ,
            'datelimitecarteproffess' => 'required|date'
        ]);

        //Validation de la durée du contrat si ce n'est pas un cdi
        $validatedData->sometimes('dureeducontrat','required|digits_between:1,3', function ($input) use ($request) {
            return $request->typecontrat!='cdi';
        });

        //Validation si ADS est coché
        $validatedData->sometimes('numeroads','required|min:5', function ($input) use ($request) {
            return $request->ads==='on';
        });

        //Validation si maitre chien est coché
        $validatedData->sometimes('nomchien','required|min:2', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });

        $validatedData->sometimes('datevaliditevaccin','required|date', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });

        if ($request->ajax()) {
            return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
          }

        $validatedData= $validatedData->validate();
        $validatedData['dateentree']=$request->dateentree;
        $validatedData['datelimitecarteproffess']=$request->datelimiteprof;
        
        if($request->typecontrat=='cdi'){
            $validatedData['dureeducontrat'] = null;
        }else{
            $validatedData['dureeducontrat'] = $request->dureeducontrat;
        }
        if($request->ads!='on'){
            $validatedData['numeroads']=null;
        }else{
            $validatedData['numeroads']=$request->numeroads;
        }

        if($request->maitrechien!='on'){
            $validatedData['nomchien']=null;
            $validatedData['datevaliditevaccin']=null;
        }else{
            $validatedData['nomchien']=$request->nomchien;
            $validatedData['datevaliditevaccin']=$request->datevaliditevaccin;
        }

        if ($request->maitrechien=='on') {
            $validatedData['qualification']='Maître chien';
        }
        if ($request->ads=='on') {
            $validatedData['qualification']='ADS';
        }
        if ($request->ssiap1=='on') {
            $validatedData['qualification']='SSIAP1';
        }
        if ($request->ssiap2=='on') {
            $validatedData['qualification']='SSIAP2';
        }
        if ($request->chefequipe=='on') {
            $validatedData['qualification']="Chef d'équipe";
        }
        if ($request->superviseur=='on') {
            $validatedData['qualification']="Superviseur";
        }
        if ($request->commercial=='on') {
            $validatedData['qualification']="Commercial";
        }
        if ($request->agentcontrole=='on') {
            $validatedData['qualification']="Agentcontrole";
        }

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }else{
            $agent = $request->session()->get('agent');
            $agent->fill($validatedData);
            $request->session()->put('agent', $agent);
        }

        return redirect()->route('agent.step.5');
    }

    public function createForm5(Request $request) 
    {
        if(is_null($request->session()->get('agent'))){
            return redirect()->route('agent.step.1');
          }
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.form_1.form_5', compact('agent', 'departements'));
    }

    public function postCreate5(Request $request) 
    {
        if(is_null($request->session()->get('agent'))){
            return redirect()->route('agent.step.1');
          }

        $validatedData = Validator::make($request->all(), [
            'titre_sejour' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'titre_sejour_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_vitale' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_vitale_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'permis_conduire' =>'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'permis_conduire_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'piece_identite' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'piece_identite_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'passport' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'passport_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_nationale' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_nationale_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_vaccin_chien' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'recepice_titre_sejour' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            'carte_professionnelle' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
            
            'titre_sejour_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('titre_sejour'));
            }),
            'carte_vitale_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('carte_vitale'));
            }),
            'permis_conduire_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('permis_conduire'));
            }),
            'piece_identite_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('piece_identite'));
            }),
            'passport_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('passport'));
            }),
            'carte_nationale_verso' => Rule::requiredIf(function () use ($request) {
                return File::exists($request->file('carte_nationale'));
            })
            
        ]);

        if ($request->ajax()) {
            return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
          }

          $validatedData= $validatedData->validate();

          dd('end');
    }

    /** end */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 
    public function ajoutAgent(Request $request)
    {
        $departements = Departement::all();

        if(empty($request->session()->get('agent'))){
            $agent = new Agent();
            $request->session()->put('agent', $agent);
        }

        $agent = $request->session()->get('agent');
        // dd($agent);
        return view('pages.agents.create.index', compact('agent', 'departements'));
    }

    public function addAgent(Request $request)
    {

        if ($request->type == 'form_1') {
            
            $validatedData = Validator::make($request->all(),[
                'civilite'=> [
                    'required',
                      Rule::in(['M', 'Mll','Mme']),
                ],
                'statutmatrimonial'=> [
                      'required',
                      Rule::in(['mar', 'cel','veuf']),
                  ],
                'nom' => 'required|min:2',
                'datenaissance' => 'required|date|before:'.Carbon::now()->addYear(-18)->format('d-m-Y'),
                'prenoms' => 'required',
                'adressegeo' => 'required|min:3'
            ]);

        }
        elseif ($request->type == 'form_2') {

            $validatedData = Validator::make($request->all(),[
              
                'numeromobile' => 'required|numeric|digits:13',
                'numerofixe' => 'required|numeric|digits:13',
                'email' => 'required|email',
                'ville' => 'required|min:3',
            ]);
       
            
        }
        elseif ($request->type == 'form_3') {

            $validatedData=Validator::make($request->all(),[
                'nationalite'=> [
                      'required',
                      Rule::in(['FR', 'ET']),
                ]
            ]);
            
            $validatedData->sometimes('numerocni','required|min:5', function ($input) use ($request) {
                return $request->nationalite==='FR';
            });
            
            $validatedData->sometimes('numeroetranger','required|min:5', function ($input) use ($request) {
                return $request->nationalite==='ET';
            });
            
            $validatedData->sometimes('lieudelivrancecs','required|min:5', function ($input) use ($request) {
                return $request->nationalite==='ET';
            });
    
            $validatedData->sometimes('etablissementcartedesejour','required|date', function ($input) use ($request) {
                return $request->nationalite==='ET';
            });
    
            $validatedData->sometimes('expirationcartedesejour','required|date', function ($input) use ($request) {
                return $request->nationalite==='ET';
            });
            
            $validatedData->sometimes(['dateetablpermis','dateexpirpermis'],'required|date', function ($input) use ($request) {
                return !is_null($request->numeropermis);
            });

            $validatedData->sometimes('lieudelivrancepermis','required', function ($input) use ($request) {
                return !is_null($request->numeropermis);
            });
        }
        elseif ($request->type == 'form_4') {
            
            $validatedData=Validator::make($request->all(),[
                'typecontrat'=> [
                    'required',
                    Rule::in(['cdi', 'cdd','interim','essai']),
                ] , 
                'dateentree' => 'required|date' ,
                'datelimitecarteproffess' => 'required|date'
            ]);

            //Validation de la durée du contrat si ce n'est pas un cdi
            $validatedData->sometimes('dureeducontrat','required|digits_between:1,3', function ($input) use ($request) {
                return $request->typecontrat!='cdi';
            });

            //Validation si ADS est coché
            $validatedData->sometimes('numeroads','required|min:5', function ($input) use ($request) {
                return $request->ads==='on';
            });

            //Validation si maitre chien est coché
            $validatedData->sometimes('nomchien','required|min:2', function ($input) use ($request) {
                return $request->maitrechien==='on';
            });

            $validatedData->sometimes('datevaliditevaccin','required|date', function ($input) use ($request) {
                return $request->maitrechien==='on';
            });

        }
        else
        {

            $validatedData = Validator::make($request->all(), [
                'titre_sejour' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'titre_sejour_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_vitale' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_vitale_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'permis_conduire' =>'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'permis_conduire_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'piece_identite' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'piece_identite_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'passport' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'passport_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_nationale' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_nationale_verso' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_vaccin_chien' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'recepice_titre_sejour' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                'carte_professionnelle' => 'sometimes|image|mimes:png,jpeg,pdf|max:10000',
                
                'titre_sejour_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('titre_sejour'));
                }),
                'carte_vitale_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('carte_vitale'));
                }),
                'permis_conduire_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('permis_conduire'));
                }),
                'piece_identite_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('piece_identite'));
                }),
                'passport_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('passport'));
                }),
                'carte_nationale_verso' => Rule::requiredIf(function () use ($request) {
                    return File::exists($request->file('carte_nationale'));
                })
                
            ]);

            if ($validatedData->fails()) {
                
                return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }

        }
        
        if($validatedData->fails() && $request->ajax()){
            return response()->json($validatedData->errors(), 422);
        }

        $validatedData = $validatedData->validate();
        
        if ($request->type == 'form_1') {

            $matricule = mb_strtoupper(substr($request->nom, 0, 3).substr($request->prenoms, 0, 3).Carbon::now()->format('dmy'));
            $validatedData['matricule'] = $matricule;

        }
        elseif ($request->type == 'form_2') {
            
            $validatedData['numeromobile']=$request->numeromobile;
            $validatedData['email']=$request->email;
            $validatedData['codepostal']=$request->codepostal;
            $validatedData['adressegeo']=$request->adressegeo;
            $validatedData['numerofixe']=$request->numerofixe;
            $validatedData['departement_id']=$request->departement;
            $validatedData['ville']=$request->ville;

        }
        elseif ($request->type == 'form_3') {

            $categoriepermis=BlackshFonctions::arrayToString($request->categoriepermis);
            $validatedData['numeropermis'] = $request->numeropermis;
            $validatedData['lieudelivrancepermis'] = $request->lieudelivrancepermis;
            $validatedData['dateetablpermis'] = $request->dateetablpermis;
            $validatedData['dateexpirpermis'] = $request->dateexpirpermis;
            $validatedData['categoriepermis'] = $categoriepermis;
    
            $validatedData['numeross']=$request->numeross;
            $validatedData['numerocaf']=$request->caf;
    
            if($request->nationalite=='FR'){

              $validatedData['numerocni']=$request->numerocni;
              $validatedData['numeroetranger']=null;
              $validatedData['lieudelivrancecs']=null;
              $validatedData['etablissementcartedesejour']=null;
              $validatedData['expirationcartedesejour']=null;
              
            }else{

              $validatedData['numerocni']=null;
              $validatedData['numeroetranger']=$request->numeroetranger;
              $validatedData['lieudelivrancecs']=$request->lieudelivrancecs;
              $validatedData['etablissementcartedesejour']=$request->etablissementcartedesejour;
              $validatedData['expirationcartedesejour']=$request->expirationcartedesejour;

            }

        }
        elseif ($request->type == 'form_4') {

            $validatedData['dateentree']=$request->dateentree;
            $validatedData['datelimitecarteproffess']=$request->datelimiteprof;
            
            if($request->typecontrat=='cdi'){
                $validatedData['dureeducontrat'] = null;
            }else{
                $validatedData['dureeducontrat'] = $request->dureeducontrat;
            }
            if($request->ads!='on'){
                $validatedData['numeroads']=null;
            }else{
                $validatedData['numeroads']=$request->numeroads;
            }

            if($request->maitrechien!='on'){
                $validatedData['nomchien']=null;
                $validatedData['datevaliditevaccin']=null;
            }else{
                $validatedData['nomchien']=$request->nomchien;
                $validatedData['datevaliditevaccin']=$request->datevaliditevaccin;
            }

            if ($request->maitrechien=='on') {
                $validatedData['qualification']='Maître chien';
            }
            if ($request->ads=='on') {
                $validatedData['qualification']='ADS';
            }
            if ($request->ssiap1=='on') {
                $validatedData['qualification']='SSIAP1';
            }
            if ($request->ssiap2=='on') {
                $validatedData['qualification']='SSIAP2';
            }
            if ($request->chefequipe=='on') {
                $validatedData['qualification']="Chef d'équipe";
            }
            if ($request->superviseur=='on') {
                $validatedData['qualification']="Superviseur";
            }
            if ($request->commercial=='on') {
                $validatedData['qualification']="Commercial";
            }
            if ($request->agentcontrole=='on') {
                $validatedData['qualification']="Agentcontrole";
            }
        }
        else{


           
            if(empty($request->session()->get('agent')))
                $agent = new Agent();
            else
                $agent = $request->session()->get('agent');
                $agent->folderagent = time() .  '-'.$agent->datenaissance. '-'.$agent->nom.''.$agent->prenoms ;
                $agent->datelimitecarteproffess  = $request->datelimitecarteproffess ;
                $agent->save();

                LogActivityHelper::log("Ajout  d'un agent ", 1 , 'agent', $agent->id);
                $path = public_path().'/database/'.$agent->folderagent  ;
                File::makeDirectory($path, $mode = 0777, true, true);
                $this->storeImage($agent,$request);

                session()->flash('notification', 'Agent ajouté avec succès !');

                return redirect()->back();
            
        }
        
        if(empty($request->session()->get('agent')))
            $agent = new Agent();
        else
            $agent = $request->session()->get('agent');
        
        $agent->fill($validatedData);
        $request->session()->put('agent', $agent);

    }

    private function storeImage(Agent $agent, Request $request){      
        /**UPLOAD DES FICHIER */
        // $this->saveFile($file,$name);        
        $agent->update([
            'titre_sejour' => $request->file('titre_sejour') ? $this->saveFile( $request->file('titre_sejour'),'titre_sejour', $agent->folderagent) :  null,
            'titre_sejour_verso' => $request->file('titre_sejour_verso') ? $this->saveFile( $request->file('titre_sejour_verso'),'titre_sejour_verso', $agent->folderagent) :  null,
            'carte_vitale' => $request->file('carte_vitale') ? $this->saveFile( $request->file('carte_vitale'),'carte_vitale', $agent->folderagent) :  null,
            'carte_vitale_verso' => $request->file('carte_vitale_verso') ? $this->saveFile( $request->file('carte_vitale_verso'),'carte_vitale_verso', $agent->folderagent) :  null,
            'permis_conduire' => $request->file('permis_conduire') ? $this->saveFile( $request->file('permis_conduire'),'permis_conduire', $agent->folderagent) :  null,
            'permis_conduire_verso' => $request->file('permis_conduire_verso') ? $this->saveFile( $request->file('permis_conduire_verso'),'permis_conduire_verso', $agent->folderagent) :  null,
            'piece_identite' => $request->file('piece_identite') ? $this->saveFile( $request->file('piece_identite'),'piece_identite', $agent->folderagent) :  null,
            'piece_identite_verso' => $request->file('piece_identite_verso') ? $this->saveFile( $request->file('piece_identite_verso'),'piece_identite_verso', $agent->folderagent) :  null,
            'passport' => $request->file('passport') ? $this->saveFile( $request->file('passport'),'passport', $agent->folderagent) :  null,
            'passport_verso' => $request->file('passport_verso') ? $this->saveFile( $request->file('passport_verso'),'passport_verso', $agent->folderagent) :  null,
            'carte_nationale' => $request->file('carte_nationale') ? $this->saveFile( $request->file('carte_nationale'),'carte_nationale', $agent->folderagent) :  null,
            'carte_nationale_verso' => $request->file('carte_nationale_verso') ? $this->saveFile( $request->file('carte_nationale_verso'),'carte_nationale_verso', $agent->folderagent) :  null,
            'recepice_titre_sejour' => $request->file('recepice_titre_sejour') ? $this->saveFile( $request->file('recepice_titre_sejour'),'recepice_titre_sejour', $agent->folderagent) :  null,
            'carte_vaccin_chien' => $request->file('carte_vaccin_chien') ? $this->saveFile( $request->file('carte_vaccin_chien'),'carte_vaccin_chien', $agent->folderagent) :  null,
            'carte_professionnelle' => $request->file('carte_professionnelle') ? $this->saveFile( $request->file('carte_professionnelle'),'carte_professionnelle', $agent->folderagent) :  null,
        ]);
        request()->session()->forget('agent');
        
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
    public function edit(Request $request,$id)
    {
        $agent=Agent::where('id',$id)->firstOrFail();
        $departements = Departement::all();

        $categoriepermisArray=explode(',',$agent->categoriepermis);
        $qualificationArray=explode(',',$agent->qualification);

        if($request->ajax()){
            return response()->json(['content'=>view('pages.agents.edit',compact('agent','categoriepermisArray','qualificationArray', 'departements'))->renderSections()['content']],200);
        }
        // dd($qualificationArray,in_array('ads',$qualificationArray));
        return view('pages.agents.edit',compact('agent','categoriepermisArray','qualificationArray', 'departements'));
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
       
        $v=$this->validationsAgent($request);
        if($v->fails()){
          return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        //Enregistrement
        $agent=Agent::where('id',$id)->firstOrFail();
        $categoriepermis=BlackshFonctions::arrayToString($request->categoriepermis);
        $qualification=BlackshFonctions::qualificationString($request);
        //Enrégistrements des informations
        $agent->update([
            'civilite'=>$request->civilite,
            'statutmatrimonial'=>$request->statutmatrimonial,
            'nom' => $request->nom,
            'datenaissance' => $request->datenaissance,
            'email' => $request->email,
            'codepostal' => $request->codepostal,
            'matricule' => $request->matricule,
            'prenoms' => $request->prenoms,
            'typecontrat' => $request->typecontrat,
            'dureeducontrat' => $request->dureeducontrat,
            'nationalite'=>$request->nationalite,
            'adressegeo' => $request->adressegeo,
            'departement_id' => $request->departement,
            'numeromobile' => $request->numeromobile,
            'numerofixe' => $request->numerofixe,
            'numerocni' => $request->numerocni,
            'numeropermis' => $request->numeropermis,
            'lieudelivrancepermis' => $request->lieudelivrancepermis,
            'categoriepermis' => $categoriepermis,
            'dateetablpermis' => $request->dateetablpermis,
            'dateexpirpermis' => $request->dateexpirpermis,
            'numeross' => $request->numeross,
            'numeroetranger' => $request->numeroetranger,
            'lieudelivrancecs' => $request->lieudelivrancecs,
            'etablissementcartedesejour' => $request->etablissementcartedesejour,
            'expirationcartedesejour' => $request->expirationcartedesejour,
            'qualification' => $qualification,
            'numeroads' => $request->numeroads,
            'nomchien' => $request->nomchien,
            'datevaliditevaccin' => $request->datevaliditevaccin,
            'titre_sejour' => $request->file('titre_sejour') ? $this->saveFile( $request->file('titre_sejour'),'titre_sejour', $agent->folderagent) :  $agent->titre_sejour,
            'titre_sejour_verso' => $request->file('titre_sejour_verso') ? $this->saveFile( $request->file('titre_sejour_verso'),'titre_sejour_verso', $agent->folderagent) :  $agent->titre_sejour_verso,
            'carte_vitale' => $request->file('carte_vitale') ? $this->saveFile( $request->file('carte_vitale'),'carte_vitale', $agent->folderagent) :   $agent->carte_vitale,
            'carte_vitale_verso' => $request->file('carte_vitale_verso') ? $this->saveFile( $request->file('carte_vitale_verso'),'carte_vitale_verso', $agent->folderagent) : $agent->cacarte_vitale_versorte_vitale,
            'permis_conduire' => $request->file('permis_conduire') ? $this->saveFile( $request->file('permis_conduire'),'permis_conduire', $agent->folderagent) :   $agent->permis_conduire,
            'permis_conduire_verso' => $request->file('permis_conduire_verso') ? $this->saveFile( $request->file('permis_conduire_verso'),'permis_conduire_verso', $agent->folderagent) :   $agent->permis_conduire_verso,
            'piece_identite' => $request->file('piece_identite') ? $this->saveFile( $request->file('piece_identite'),'piece_identite', $agent->folderagent) :  $agent->piece_identite,
            'piece_identite_verso' => $request->file('piece_identite_verso') ? $this->saveFile( $request->file('piece_identite_verso'),'piece_identite_verso', $agent->folderagent) :   $agent->piece_identite_verso,
            'passport' => $request->file('passport') ? $this->saveFile( $request->file('passport'),'passport', $agent->folderagent) :  $agent->passport,
            'passport_verso' => $request->file('passport_verso') ? $this->saveFile( $request->file('passport_verso'),'passport_verso', $agent->folderagent) :   $agent->passport_verso,
            'carte_nationale' => $request->file('carte_nationale') ? $this->saveFile( $request->file('carte_nationale'),'carte_nationale', $agent->folderagent) :   $agent->carte_nationale,
            'carte_nationale_verso' => $request->file('carte_nationale_verso') ? $this->saveFile( $request->file('carte_nationale_verso'),'carte_nationale_verso', $agent->folderagent) :  $agent->carte_nationale_verso,
            'recepice_titre_sejour' => $request->file('recepice_titre_sejour') ? $this->saveFile( $request->file('recepice_titre_sejour'),'recepice_titre_sejour', $agent->folderagent) :  $agent->recepice_titre_sejour,
            'carte_vaccin_chien' => $request->file('carte_vaccin_chien') ? $this->saveFile( $request->file('carte_vaccin_chien'),'carte_vaccin_chien', $agent->folderagent) :  $agent->carte_vaccin_chien,
            'carte_professionnelle' => $request->file('carte_professionnelle') ? $this->saveFile( $request->file('carte_professionnelle'),'carte_professionnelle', $agent->folderagent) : $agent->carte_professionnelle,
        ]);
        LogActivityHelper::log("Mise à jour  d'un agent ", 2 , 'agent', $agent->id);
        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent=Agent::where('id',$id)->firstOrFail();

        $result=$agent->delete();
        
        $agents=Agent::all();
        // $new_content=view('pages.agents.table',compact('agents'))->render();
        
        return back()->with('success','Suppression effectué');

    }

    //Fonction validation des données
    private function validationsAgent(Request $request){
      //Validation de données
      $v=Validator::make($request->all(),[
          'civilite'=> [
              'required',
                Rule::in(['M', 'Mll','Mme']),
          ],
          'statutmatrimonial'=> [
                'required',
                Rule::in(['mar', 'cel','veuf']),
            ],
          'nom' => 'required|min:2',
          'datenaissance' => 'required',
          'matricule' => 'required',
          'prenoms' => 'required',
          'typecontrat'=> [
                'required',
                Rule::in(['cdi', 'cdd','interim','essai']),
          ],
          'nationalite'=> [
                'required',
                Rule::in(['FR', 'ET'])
          ] ,
          'dateentree' => 'required|date' ,
          'datelimitecarteproffess' => 'required|date' ,
        //   'categoriepermis' => [
        //     'required|array'
        //     // ,
        //     // Rule::in(['AM','A','A1','A2','B','B1','BE','C','C1','CE','C1E','D','D1','DE','D1E'])
        //   ]
      ]);


    //   $v->sometimes('categoriepermis', ['array', ], function ($input) use ($request) {
    //     return !is_null($request->categoriepermis);
    // });
      //Validation si la nationalité est Française
      $v->sometimes('numerocni','required|min:5', function ($input) use ($request) {
          return $request->nationalite==='FR';
      });

      $v->sometimes('dateexpircni','required|date', function ($input) use ($request) {
          return $request->nationalite==='FR';
      });

      //Validation si la nationalité est étrangère
      $v->sometimes('numeroetranger','required|min:5', function ($input) use ($request) {
          return $request->nationalite==='ET';
      });

      $v->sometimes('lieudelivrancecs','required|min:5', function ($input) use ($request) {
          return $request->nationalite==='ET';
      });

      $v->sometimes('etablissementcartedesejour','required|date', function ($input) use ($request) {
          return $request->nationalite==='ET';
      });

      $v->sometimes('expirationcartedesejour','required|date', function ($input) use ($request) {
          return $request->nationalite==='ET';
      });
      //Validation si le permis est saisie
      $v->sometimes(['dateetablpermis','dateexpirpermis'],'required|date', function ($input) use ($request) {
          return !is_null($request->numeropermis);
      });
    
      //Validation de la durée du contrat si ce n'est pas un cdi
      $v->sometimes('dureeducontrat',['required',Rule::in(['3mois', '6mois','1ans','2ans'])], function ($input) use ($request) {
          return $request->typecontrat!='cdi';
      });
      //Validation si ADS est coché
      $v->sometimes('numeroads','required|min:5', function ($input) use ($request) {
          return $request->ads==='on';
      });
      //Validation si maitre chien est coché
      $v->sometimes('nomchien','required|min:2', function ($input) use ($request) {
          return $request->maitrechien==='on';
      });
      $v->sometimes('datevaliditevaccin','required|date', function ($input) use ($request) {
          return $request->maitrechien==='on';
      });
      //Retour des erreurs
      return $v;
    }

    public function exceleprint( $id )
    {
        $agent = Agent::find($id);
        $titre = $agent->nom . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
        return Excel::download(new AgentExcel( $agent ), $titre . '.xlsx');
    }

    public function pdf_agent( $id )
    {   
        // $agent = Agent::find($agent);

        // return view('pages/agents/agentinfo',compact('agent'));
        $agent = Agent::find($id);
        $pdf = PDF::loadView('pages/agents/agentinfo', compact('agent'));
        // $pdf->setPaper('A4', 'landscape');
        $name = "agent-".$agent->nom. '-' .$agent->prenoms. ".pdf";

        //dd($agent); die();
        return $pdf->download($name);

    }

    public  function  saveFile( $file , $name ,$folder )
    {
        $new_name = $name . rand() .'.'. $file->getClientOriginalExtension() ;
        $file->move(public_path('/database/'.$folder.'/'), $new_name);
        return $new_name ;
    }
}
       
