<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        'name'=> 'required|max:255' ,// ili niz ['reuired', 'max']
        'lastname'=> 'required|max:255' ,
        'email'=> 'required|email|max:255' ,
        'password'=> 'required|confirmed' ,///traziti ce  _confirmation, pa je bitno kako se imanuje na formi
       ]);
        
       User::create([
        'name'=>$request->name,
        'lastname'=>$request->lastname,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
       ]);

        auth()->attempt($request->only('email','password'));
    
    return redirect()->route('proizvodi');

     // dd($request);//kill page i ispise abc
    }
}