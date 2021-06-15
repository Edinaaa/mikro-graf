<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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


    /**
     * Where to redirect users after login.
     *
     * @var string
    
     *use AuthenticatesUsers;
   * protected $redirectTo = RouteServiceProvider::HOME;
*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){

        
        return view('auth.login');
    }

    public function store(Request $request){

        $this->validate($request,[
            
            'email'=> 'required|email' ,
            'password'=> 'required' ,
           ]);
     
        if( !auth()->attempt($request->only('email','password'), $request->remember))
            {

                return back()->with('status','Pogresan unos!');
            }
        return redirect()->route('proizvodi');
    }
}
