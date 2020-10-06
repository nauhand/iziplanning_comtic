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

use App\Helpers\LogActivityHelper;

class AgentController extends Controller
{
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
               
            ]);

        }
        elseif ($request->type == 'form_2') {

            $validatedData = Validator::make($request->all(),[

                'numeromobile' => 'required|numeric|digits:13',
                // 'numerofixe' => 'required|numeric|digits:13',
                // 'email' => 'required|email',
                'ville' => 'required|min:3',
                'adressegeo' => 'required|min:3'
            ]);


        }
        elseif ($request->type == 'form_3') {

            $validatedData=Validator::make($request->all(),[
                'nationalite'=> [
                    'required',
                    Rule::in(['FR', 'ET']),
                ] ,
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

            $validatedData->sometimes(['dateetablpermis'],'required|date', function ($input) use ($request) {
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

            // Validation de la durée du contrat si ce n'est pas un cdi
            $validatedData->sometimes('dureeducontrat','required', function ($input) use ($request) {
                return $request->typecontrat!='cdi';
            });

            //Validation si ADS est coché
            $validatedData->sometimes('numeroads','required|min:5', function ($input) use ($request) {
                return $request->ads==='on';
            });

            // //Validation si maitre chien est coché
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
                'titre_sejour' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'titre_sejour_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'carte_vitale' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
//                'carte_vitale_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'permis_conduire' =>'sometimes|mimes:png,jpeg,pdf|max:100000',
                'permis_conduire_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
//                'piece_identite' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
//                'piece_identite_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'passport' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'passport_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'carte_nationale' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'carte_nationale_verso' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'carte_vaccin_chien' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'recepice_titre_sejour' => 'sometimes|mimes:png,jpeg,pdf|max:100000',
                'carte_professionnelle' => 'sometimes|mimes:png,jpeg,pdf|max:100000',

                // 'titre_sejour_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('titre_sejour'));
                // }),
                // 'carte_vitale_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('carte_vitale'));
                // }),
                // 'permis_conduire_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('permis_conduire'));
                // }),
                // 'piece_identite_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('piece_identite'));
                // }),
                // 'passport_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('passport'));
                // }),
                // 'carte_nationale_verso' => Rule::requiredIf(function () use ($request) {
                //     return File::exists($request->file('carte_nationale'));
                // })

            ]);


            if ($validatedData->fails()) {
                return response()->json($validatedData->errors(), 422);
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
            $validatedData['categoriepermis'] = $categoriepermis;

            $validatedData['numeross']=$request->numeross;
            $validatedData['nationalite'] = $request->nationalite != null  ? $request->nationalite : null ;

            $validatedData['numeroetranger']=$request->numeroetranger ? $request->numeroetranger : null ;
            $validatedData['lieudelivrancecs']=$request->lieudelivrancecs ? $request->lieudelivrancecs : null ;
            $validatedData['etablissementcartedesejour']= $request->etablissementcartedesejour ? $request->etablissementcartedesejour : null;
            $validatedData['expirationcartedesejour']=$request->expirationcartedesejour ? $request->expirationcartedesejour : null ;

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
            if ($request->assitanceRh=='on') {
                $validatedData['qualification']="Assistance RH";
            }
            if ($request->responsableRh=='on') {
                $validatedData['qualification']="Responsable RH";
            }
            if ($request->comptable_assistant=='on') {
                $validatedData['qualification']="Assistance comptable ";
            }
            if ($request->comptable=='on') {
                $validatedData['qualification']="comptable ";
            }
            if ($request->comptable_expert=='on') {
                $validatedData['qualification']="Expert Comptable ";
            }
        }
        else{

            if(empty($request->session()->get('agent')))
                $agent = new Agent();
            else
            $agent = $request->session()->get('agent');
            $agent->folderagent = time() .  '-'.$request->datenaissance. '-'.$request->nom.''.$request->prenoms ;
            $agent->nom = $request->nom ;
            $agent->datenaissance =$request->datenaissance ;
            $agent->civilite =$request->civilite ;
            $agent->prenoms = $request->prenoms ;
            $agent->statutmatrimonial = $request->statutmatrimonial ;
            $agent->datelimitecarteproffess  = $request->datelimitecarteproffess ;
            $agent->dateentree  = $request->dateentree ;
            $agent->numeropermis  = $request->numeropermis ;
            $agent->lieudelivrancepermis  = $request->lieudelivrancepermis ;
            $agent->dateetablpermis  = $request->dateetablpermis  ;
            $agent->nationalite  = $request->nationalite != null  ? $request->nationalite : null ;
            $agent->numerocni  = $request->numerocni  != null ?  $request->numerocni  : null ;
            $agent->numeroetranger  = $request->numeroetranger  != null ?  $request->numeroetranger  : null  ;
            $agent->lieudelivrancecs  = $request->lieudelivrancecs != null ? $request->lieudelivrancecs  : null  ;
            $agent->etablissementcartedesejour  = $request->etablissementcartedesejour != null ? $request->etablissementcartedesejour  : null  ;
            $agent->expirationcartedesejour  = $request->expirationcartedesejour != null ? $request->expirationcartedesejour  : null  ;
            $agent->numeross  = $request->numeross != null ? $request->numeross  : null  ;
            $agent->categoriepermis  = BlackshFonctions::arrayToString($request->categoriepermis)  ;
            $agent->numerocartepro  = $request->numerocartepro != null ?  $request->numerocartepro : null ;
            $agent->numeroads  = $request->numeroads != null ?  $request->numeroads : null ;
            $agent->save();

            LogActivityHelper::log("Ajout  d'un agent ", 1 , 'agent', $agent->id);
            $path = public_path().'/../uploads/folder_agents/'.$agent->folderagent  ;
            File::makeDirectory($path, $mode = 0777, true, true);
            $this->storeImage($agent,$request);

            //                session()->flash('success', 'Agent ajouté avec succès !');
            return redirect()->route('agent.index')->with("success",'Agent ajouté avec succès !');


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
            'permis_conduire' => $request->file('permis_conduire') ? $this->saveFile( $request->file('permis_conduire'),'permis_conduire', $agent->folderagent) :  null,
            'permis_conduire_verso' => $request->file('permis_conduire_verso') ? $this->saveFile( $request->file('permis_conduire_verso'),'permis_conduire_verso', $agent->folderagent) :  null,
//            'piece_identite' => $request->file('piece_identite') ? $this->saveFile( $request->file('piece_identite'),'piece_identite', $agent->folderagent) :  null,
//            'piece_identite_verso' => $request->file('piece_identite_verso') ? $this->saveFile( $request->file('piece_identite_verso'),'piece_identite_verso', $agent->folderagent) :  null,
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

    public  function  saveFile( $file , $name ,$folder  , $update = null )
    {
         $new_name = $name . rand() .'.'. $file->getClientOriginalExtension() ;
         if($update) {
            $new_name = $new_name . 'update' ;
         }
        // $file->move(public_path('../uploads/folder_agents/'.$folder.'/'), $new_name);
        $file->move(public_path().'/../uploads/folder_agents/'.$folder , $new_name);
        return $new_name ;
    }


    public function SaveFilePost($id, Request $request)
    {
        dd($id);
    }


    public function update(Request $request, $id)
    {

        $v=$this->validationsAgent($request);
        // dd($v->errors()->messages());
        if($v->fails()){
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }

        //Enregistrement
        $agent=Agent::where('id',$id)->firstOrFail();

        if(!$agent->folderagent) {
            $folder = time() . '-' . $agent->datenaissance . '-' . $agent->matricule . ''.time();
            // $path = public_path() . '/../uploads/folder_agents/' . $folder;
            $path = public_path().'/../uploads/folder_agents/'.$folder;
            File::makeDirectory($path, $mode = 0777, true, true);
            $agent->update([
                'folderagent' => $folder,
            ]);
        }
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
//            'matricule' => $request->matricule,
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
            'dateexpircni' => $request->dateexpircni,
            'numeross' => $request->numeross,
            'numeroetranger' => $request->numeroetranger,
            'lieudelivrancecs' => $request->lieudelivrancecs,
            'dateentree' => $request->dateentree,
            'datelimitecarteproffess' => $request->datelimitecarteproffess,
            'etablissementcartedesejour' => $request->etablissementcartedesejour,
            'expirationcartedesejour' => $request->expirationcartedesejour,
            'qualification' => $qualification,
            'nomchien' => $request->nomchien,
            'numerocartepro' => $request->numerocartepro ,
            'numeroads' => $request->numeroads , 
            'datevaliditevaccin' => $request->datevaliditevaccin,
            'titre_sejour' => $request->file('titre_sejour') ? $this->saveFile( $request->file('titre_sejour'),'titre_sejour', $agent->folderagent , true) :  $agent->titre_sejour,
            'titre_sejour_verso' => $request->file('titre_sejour_verso') ? $this->saveFile( $request->file('titre_sejour_verso' , true),'titre_sejour_verso', $agent->folderagent) :  $agent->titre_sejour_verso,
            'carte_vitale' => $request->file('carte_vitale') ? $this->saveFile( $request->file('carte_vitale'),'carte_vitale', $agent->folderagent , true) : $agent->carte_vitale,
//            'carte_vitale_verso' => $request->file('carte_vitale_verso') ? $this->saveFile( $request->file('carte_vitale_verso'),'carte_vitale_verso', $agent->folderagent) :  $agent->carte_vitale_verso,
            'permis_conduire' => $request->file('permis_conduire') ? $this->saveFile( $request->file('permis_conduire'),'permis_conduire', $agent->folderagent , true ) :  $agent->permis_conduire,
            'permis_conduire_verso' => $request->file('permis_conduire_verso') ? $this->saveFile( $request->file('permis_conduire_verso' , true ),'permis_conduire_verso', $agent->folderagent) :  $agent->permis_conduire_verso,
//            'piece_identite' => $request->file('piece_identite') ? $this->saveFile( $request->file('piece_identite'),'piece_identite', $agent->folderagent) :  $agent->piece_identite,
//            'piece_identite_verso' => $request->file('piece_identite_verso') ? $this->saveFile( $request->file('piece_identite_verso'),'piece_identite_verso', $agent->folderagent) :  $agent->piece_identite_verso,
            'passport' => $request->file('passport') ? $this->saveFile( $request->file('passport'),'passport', $agent->folderagent , true ) :  $agent->passport,
            'passport_verso' => $request->file('passport_verso') ? $this->saveFile( $request->file('passport_verso'),'passport_verso', $agent->folderagent , true ) :  $agent->passport_verso,
            'carte_nationale' => $request->file('carte_nationale') ? $this->saveFile( $request->file('carte_nationale'),'carte_nationale', $agent->folderagent , true ) :  $agent->carte_nationale,
            'carte_nationale_verso' => $request->file('carte_nationale_verso') ? $this->saveFile( $request->file('carte_nationale_verso'),'carte_nationale_verso', $agent->folderagent , true ) : $agent->carte_nationale_verso,
            'recepice_titre_sejour' => $request->file('recepice_titre_sejour') ? $this->saveFile( $request->file('recepice_titre_sejour'),'recepice_titre_sejour', $agent->folderagent , true ) : $agent->recepice_titre_sejour,
            'carte_vaccin_chien' => $request->file('carte_vaccin_chien') ? $this->saveFile( $request->file('carte_vaccin_chien'),'carte_vaccin_chien', $agent->folderagent , true ) :  $agent->carte_vaccin_chien,
            'carte_professionnelle' => $request->file('carte_professionnelle') ? $this->saveFile( $request->file('carte_professionnelle'),'carte_professionnelle', $agent->folderagent , true ) :   $agent->carte_professionnelle,
        ]);
        LogActivityHelper::log("Mise à jour  d'un agent ", 2 , 'agent', $agent->id);
        return redirect()->route('agent.index')->with("success",'La mise à jour a été effectué avec succès');
    }

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
//            'matricule' => 'required',
            'prenoms' => 'required',
            // 'typecontrat'=> [
            //     'required',
            //     Rule::in(['cdi', 'cdd','interim','essai']),
            // ],
            'nationalite'=> [
                'required',
                Rule::in(['FR', 'ET'])
            ] ,
            'dateentree' => 'date' ,
            'datelimitecarteproffess' => 'date' ,


            // 'titre_sejour' => 'mimes:png,jpeg,pdf|max:100000',
            // 'titre_sejour_verso' => 'mimes:png,jpeg,pdf|max:100000',
            // 'carte_vitale' => 'mimes:png,jpeg,pdf|max:100000',
            // 'carte_vitale_verso' => 'mimes:png,jpeg,pdf|max:100000',
            // 'permis_conduire' =>'mimes:png,jpeg,pdf|max:100000',
            // 'permis_conduire_verso' => 'mimes:png,jpeg,pdf|max:100000',
            // 'piece_identite' => 'mimes:png,jpeg,pdf|max:100000',
            // 'piece_identite_verso' => 'mimes:png,jpeg,pdf|max:100000',
            // 'passport' => 'mimes:png,jpeg,pdf|max:100000',
            // 'passport_verso' => 'mimes:png,jpeg,pdf|max:10010000000',
            // 'carte_nationale' => 'mimes:png,jpeg,pdf|max:100000',
            // 'carte_nationale_verso' => 'mimes:png,jpeg,pdf|max:100000',
            // 'carte_vaccin_chien' => 'mimes:png,jpeg,pdf|max:100000',
            // 'recepice_titre_sejour' => 'mimes:png,jpeg,pdf|max:100000',
            // 'carte_professionnelle' => 'mimes:png,jpeg,pdf|max:100000',

        ]);

        $v->sometimes('categoriepermis', ['array', ], function ($input) use ($request) {
            return !is_null($request->categoriepermis);
        });
        //Validation si la nationalité est Française
        // $v->sometimes('numerocni','min:5', function ($input) use ($request) {
        //     return $request->nationalite==='FR';
        // });

        // $v->sometimes('dateexpircni','date', function ($input) use ($request) {
        //     return $request->nationalite==='FR';
        // });

        //Validation si la nationalité est étrangère
        $v->sometimes('numeroetranger','min:5', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $v->sometimes('lieudelivrancecs','min:5', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $v->sometimes('etablissementcartedesejour','date', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });

        $v->sometimes('expirationcartedesejour','date', function ($input) use ($request) {
            return $request->nationalite==='ET';
        });
        //Validation si le permis est saisie
        $v->sometimes(['dateetablpermis','dateexpirpermis'],'date', function ($input) use ($request) {
            return !is_null($request->numeropermis);
        });

        //Validation de la durée du contrat si ce n'est pas un cdi
        // $v->sometimes('dureeducontrat',[Rule::in(['3mois', '6mois','1ans','2ans'])], function ($input) use ($request) {
        //     return $request->typecontrat!='cdi';
        // });
        //Validation si ADS est coché
        $v->sometimes('numeroads','min:5', function ($input) use ($request) {
            return $request->ads==='on';
        });
        //Validation si maitre chien est coché
        $v->sometimes('nomchien','min:2', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });
        $v->sometimes('datevaliditevaccin','date', function ($input) use ($request) {
            return $request->maitrechien==='on';
        });

        //Retour des erreurs
        return $v;
    }


}