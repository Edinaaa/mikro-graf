<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create(){
        if(Auth::check()){

            $user= User::find(auth()->id());
            return view('user.user',['user'=>$user]);
        }
        $request->session()->flash('alert-info','Registrujte se da bi imali pregled profila.');
        
        return view('auth.register');

    }
    public function update(Request $request, $id){
        if(Auth::check()){
            $this->validate($request,[
                'name'=> 'required|max:15' ,
                'lastname'=> 'required|max:20' ,
                'telefon'=> 'required|max:15' ,
                'email'=> 'required|email|max:191' ,
            ]);
                $user= User::find($id);
                $user->name=$request->name;
                $user->lastname=$request->lastname;
                $user->telefon=$request->telefon;
                $user->email=$request->email;
                if($request->password!=null){
                    $this->validate($request,[
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

                    $user->password=Hash::make($request->password);

                }
                $user->save();
                Auth::login($user);
        //auth()->attempt(['email'=>$user->email,'password'=>$user->password]);
        $request->session()->flash('alert-success', 'Uspjesno izmjenjeni podaci.');
        return redirect()->route('proizvodi');
        }
        $request->session()->flash('alert-info','Registrujte se da bi imali pregled profila.');
        
        return view('auth.register');
        

    }
}
