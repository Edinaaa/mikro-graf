<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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

        auth()->attempt($request->only('email','password'));
    
        return redirect()->route('proizvodi');

     // dd($request);//kill page i ispise abc
    }
}
