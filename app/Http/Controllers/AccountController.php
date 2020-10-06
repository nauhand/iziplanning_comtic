<?php
namespace App\Http\Controllers;


use App\Helpers\LogActivityHelper;
use Carbon\Carbon;
use Validator;
use App\Exports\UserExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\AccountHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\User ;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Session;
use PDF;
class AccountController extends Controller
{
  /**
  *@$this control manage all settin of account
  */
  public function __construct()
    {
        $this->middleware('auth');
    }
  /**
   *
   */
  public function execelUsers()
  {
    $titre = 'utilisateurs' . ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD_MMM_YYYY'));
    return Excel::download(new UserExportExcel(), $titre . '.xlsx');
  }
  public function Pdfuser()
  {
    $user = User::all();
    $users = DB::table('users')
    ->select('*')
    ->where('id','!=',Auth::user()->id)
    ->get();
    $pdf = PDF::loadView('pages/account/users_pdf', compact( 'users'));
    $name = "users.pdf";
    return $pdf->download($name);
  }
  public function form()
  {
    return view('pages.account.form');
  }
  public function store(Request $request )
  {
    $validatedData = Validator::make($request->all(),[
        'nom' => [
          'required' ,
          'min:2'
        ],
        'prenoms' => [
          'required' ,
          'min:2'
        ],
        'accountype' => [
            'required'
        ],
        'numeromobile' => [
          'required','numeric','digits:13'
        ],
        'email' => [
          'required' ,
          'email',
          'unique:Users'
        ],
        'password' => [
          'required' ,
          'min:4'
          ]
    ]);
    if($validatedData->fails()){
          return redirect('gestion-des-comptes/ajouter-un-admin')->withErrors($validatedData)->withInput();
       } else {
        $email =  User::where('email',$request->email)->count();
        $numeromobile =  User::where('numeromobile',$request->numeromobile)->count();
        if($email > 0 ) {
            return redirect('gestion-des-comptes/ajouter-un-admin')->withErrors(['email' => 'L\'adresse email est associé a un autre compte'])->withInput();
        } else if ( $numeromobile > 0){
          return redirect('gestion-des-comptes/ajouter-un-admin')->withErrors(['numeromobile' => 'Le numéro  est associé a un autre compte'])->withInput();
        } else
          {
           $user = DB::table('users')->insertGetId([
               'nom'=>$request->nom,
               'prenoms'=>$request->prenoms,
               'email'=>$request->email,
               'numeromobile'=>$request->numeromobile,
               'is_admin'=> $request->accountype == 1 ? true : false  ,
               'is_active'=>true,
               'password'=>\Hash::make( $request->password),
           ]);
           LogActivityHelper::log("Insertion d'un nouveau utilisateur ",1,'users',$user);
           return redirect('gestion-des-comptes/ajouter-un-admin')->with("successadmin","Le compte de $request->nom $request->prenoms a été crée avec succès " );
         }
       }
  }
    public function listUsers()
    {
      $data = DB::table('users')
      ->select('*')
      ->where('id','!=',Auth::user()->id)
      ->get();
      return view('pages.account.index', compact('data'));
    }
    public function action(Request $request)
    {
      if($request->type == 'state') {
        $update= ['is_active' => $request->newstate];
        $user = User::find($request->userid)->update($update);
        LogActivityHelper::log($request->newstate ? " Desactivation d'un compte  " :  " Activation d'un compte  " ,1,'users',$user);
        return  $request->newstate ? redirect('gestion-des-comptes/')->with("successadmin","Le compte de $request->nom $request->prenoms a été activé avec succès " ) :
                                    redirect('gestion-des-comptes/')->with("successadmin","Le compte de $request->nom $request->prenoms a été desactivé avec succès " ) ;
      } else if($request->type == 'delete') {

        User::find($request->userid)->delete();
          LogActivityHelper::log($request->newstate ? " Desactivation d'un compte  " :  " Activation d'un compte  " ,1,'users',0);
          return  redirect('gestion-des-comptes/')->with("successadmin","Le compte de $request->nom $request->prenoms a été supprimé avec succès " ) ;
      }else if($request->type == 'update') {
        $user = User::find($request->userid);
        $request->session()->put('update', $user);
        return  view('pages.account.edit', compact('user')) ;
      }
    }
    public function form_to_Update(Request $request)
    {
      $user =  $request->session()->get('update');
      return view('pages.account.edit')->with('user',$user);
    }
    public function update(Request $request)
    {
      $validatedData = Validator::make($request->all(),[
        'nom' => [
          'required' ,
          'min:2'
        ],
        'prenoms' => [
          'required' ,
          'min:2'
        ],
        'accountype' => [
            'required'
        ],
        'numeromobile' => [
          'required','numeric','digits:13'
        ],
        'email' => [
          'required' ,
          'email',
        ],
    ]);
        if($validatedData->fails()){
          $user = User::find($request->userid);
          return redirect()->route('account.edit')->withErrors($validatedData)->withInput()->with('user',$user);
      } else {
        // verifier que l'email est unique
        $userCurrent = $request->session()->get('update');
        $user = User::select(DB::raw('count(id) as count, id ,email'))->where('email',$request->email)->get();
        if($user[0]->count == 0) {
          $userCurrent->update([
            'nom'=> $request->nom ?? $userCurrent->nom ,
            'prenoms'=>  $request->prenoms ?? $userCurrent->prenoms ,
            'email'=>$request->email ?? $userCurrent->email ,
            'numeromobile'=>$request->numeromobile ?? $userCurrent->numeromobile ,
            'is_admin'=> $request->accountype == 1 ? true : false  ?? $userCurrent->numeromobile ,
            'is_active'=> true,
            'password'=> $request->password ? \Hash::make($request->password) :  $userCurrent->password,
          ]);
            LogActivityHelper::log("Mise a jour du compte d'un utilisateur ",1,'users',$userCurrent->id);
            return redirect('gestion-des-comptes/')->with("successadmin","Le compte de $request->nom $request->prenoms a été mis à jour avec succès " );
        } elseif( $user[0]->count == 1 && $user[0]->id == $userCurrent->id){
          $userCurrent->update([
            'nom'=> $request->nom ?? $userCurrent->nom ,
            'prenoms'=>  $request->prenoms ?? $userCurrent->prenoms ,
            'email'=>$request->email ?? $userCurrent->email ,
            'numeromobile'=>$request->numeromobile ?? $userCurrent->numeromobile ,
            'is_admin'=> $request->accountype == 1 ? true : false  ?? $userCurrent->numeromobile ,
            'is_active'=> true,
            'password'=> $request->password ? \Hash::make($request->password) :  $userCurrent->password,
          ]);
            LogActivityHelper::log("Mise a jour du compte d'un utilisateur ",1,'users',$userCurrent->id);
          return redirect('gestion-des-comptes/')->with("successadmin","Le compte de $request->nom $request->prenoms a été mis à jour avec succès " );
        } else {
          return redirect('gestion-des-comptes/mise-a-jour-info')->withErrors(['email' => 'L\'adresse email est associé a un autre compte'])->withInput();
        }
        // verifier que le numero est unique
        }
      }
}