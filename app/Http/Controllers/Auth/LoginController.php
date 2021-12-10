<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/tableau-de-bord';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
        {
            $this->validate($request, [
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1], $request->get('remember'))) {

                return redirect()->intended('/tableau-de-bord/')->with("successlogin","Bienvenue : ".Auth::user()->nom.' '.Auth::user()->prenoms." !"  );

            }else{

                return back()->withInput($request->only('username', 'remember'))->with("dontexist","Vous n'avez pas accès à ce site, veuillez contacter l'administrateur de ce site s'il vous plait ! " );
            }
        }

        public function username()
        {
            return 'email';
        }
}
