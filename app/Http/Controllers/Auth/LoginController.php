<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Helper\EmailVerifikacijaPosaljiLink;
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
            
            'email'=> 'required|email|max:191' ,
            'password'=> [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
                'max:100', 
            ],
           ]);
        
           $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
            'email_verified_at' => $request['password'],

        ];
        $validan=emailVerifikacijaPosaljiLink::ProvjeriEmail($request->email);
        if(!$validan){
            emailVerifikacijaPosaljiLink::PosaljiLink($request->email);
                $request->session()->flash('alert-warning', "Email nije verifikovan! Provjerite vaš email, kliknite na dugme Verifikuj email da bi ste se mogli logirati.");
                return back()->with('status','Email nije verifikovan!');
        }
        if( !auth()->attempt($request->only('email','password'), $request->remember))
            {
                $request->session()->flash('alert-warning', 'Pogresan unos!');
                return back()->with('status','Pogresan unos!');
            }
        
        return redirect()->route('home');
    }
}
