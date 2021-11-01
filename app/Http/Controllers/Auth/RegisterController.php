<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helper\EmailVerifikacijaPosaljiLink;

use Session;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){

        $this->middleware(['guest']);

   }   
    public function index(){

        return view('auth.register');
    }
    public function emailVerifikacija(Request $request){
        
       
       $message= emailVerifikacijaPosaljiLink::ValidirajEmail($request->token);
       $request->session()->flash('alert-success', $message);

        return back();
    }
    public function store(Request $request){

       // $this->validate();u baznom kontroleru ima validate metoda
       $this->validate($request,[
        'name'=> 'required|max:15' ,// ili niz ['reuired', 'max']
        'lastname'=> 'required|max:20' ,
        'telefon'=> 'required|max:15' ,
        'email'=> 'required|email|max:191' ,
        'password'=>[
            'required',
            'string',
            'min:8',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'max:100',
            'confirmed'//traziti ce  _confirmation, pa je bitno kako se imanuje na formi
        ],
       ]);
       $users=User::where('email','=',$request->get('email'))->get();

       if($users->count()!=0){
        $request->session()->flash('alert-warning',"Već postoji korisnik sa tim emailom, možete se logirati sa unesenim emailom ili se registrovati sa drugim.");
        return back();
        }
       else{
       
            $user= User::create([
                'name'=>$request->name,
                'lastname'=>$request->lastname,
                'telefon'=>$request->telefon,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);

            $kupac=Role::where('name','=','Kupac')->first();
            if($kupac==null)
            {
                $kupac=Role::create([
                    'name'=>'Kupac',
                    'slug'=>'kupac',

                ]);
            }
            $user->roles()->attach($kupac);
           $message= emailVerifikacijaPosaljiLink::PosaljiLink($request->email);
       $request->session()->flash('alert-success', $message);
            
            return redirect()->route('home');
       }
      
        
    }
}
