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
        return view('auth.register');

    }
    public function update(Request $request, $id){
        if(Auth::check()){
            $this->validate($request,[
                'lastname'=> 'required|max:255' ,
                'telefon'=> 'required|max:255' ,
                'email'=> 'required|email|max:255' ,
            ]);
                $user= User::find($id);
                $user->name=$request->name;
                $user->lastname=$request->lastname;
                $user->telefon=$request->telefon;
                $user->email=$request->email;
                if($request->password!=null){
                    $this->validate($request,[
                        'password'=> 'required|confirmed',
                    ]);
                    $user->password=Hash::make($request->password);

                }
                $user->save();
        }
      
        Auth::login($user);
        //auth()->attempt(['email'=>$user->email,'password'=>$user->password]);
        $request->session()->flash('alert-success', 'Uspjesno izmjenjeni podaci.');
        return redirect()->route('proizvodi');

     // dd($request);//kill page i ispise abc
    }
}
