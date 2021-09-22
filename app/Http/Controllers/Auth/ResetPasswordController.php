<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\ResetPass;
use Session;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Resetpasses;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;


class ResetPasswordController extends Controller
{
    //
    public function index(){

        
        return view('auth.resetpassword');
    }
    public function create(Request $request ){

        $request->validate([
            'email' => 'required|email',
            'captcha' => 'required|captcha'
        ]);
        $users=User::where('email','=',$request->get('email'))->get();
        $rp=ResetPass::get();
        if($users->count()!=0){
            $token="";
            
            do {
                $token=Str::random(100);

            } while ($rp->firstWhere('token', $token)!=null);
            $resetPass=ResetPass::Create([
                "email"=>$users[0]->email,
                "aktivan"=>1,
                "token"=>$token
            ]);

            $link=action([ResetPasswordController::class, 'newpass'], ['token' => $token]);
            
            Mail::to($users[0])->send(new Resetpasses($link));

        }
    $request->session()->flash('alert-success', 'Ako postoji račun sa vašom email adresom, link za reaktivaciju je poslan na email.');
        
      return redirect()->action([LoginController::class, 'index']);
    }

    public function newpass(Request $request){

        $prije5min= Carbon::now()->addMinute(-5);
       
        $rp=ResetPass::where("token","=",$request->get("token"))
        ->where("aktivan","=",1)
        ->where("created_at",">", $prije5min)
        ->get();
       
        if($rp->count()==0){
            $request->session()->flash('alert-warning', 'Greška, pokušajte ponovo.');
            return redirect()->action([LoginController::class, 'index']);
        }
        else{
            return view('auth.newpass',['ResetPass'=>$rp]);
        }
           
        
    }

    public function novalozinka(Request $request){

        $this->validate($request,[
            'ResetPassId'=> 'required' ,
            'email'=> 'required|email|max:255' ,
            'password'=> 'required|confirmed' ,///traziti ce  _confirmation, pa je bitno kako se imanuje na formi
           ]);
        $user=User::where('email','=',$request->get('email'))->first();
        $user->password=Hash::make($request->password);
        $user->save();
        $rp=ResetPass::find($request->get('ResetPassId'));
        $rp->aktivan=0;
        $rp->save();
        $request->session()->flash('alert-success', 'Uspješno pomjenjena lozinka, sada se možete prijaviti sa novom lozinkom.');

        return redirect()->action([LoginController::class, 'index']);

    }

    public function reloadCaptcha()
    {
       
        return response()->json(['captcha'=> captcha_img()]);

    }
}
