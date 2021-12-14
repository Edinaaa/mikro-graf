<?php
namespace App\Helper;
use App\Models\User;
use App\Models\EmailVerifikacija;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifikacije;
use Carbon\Carbon;

class EmailVerifikacijaPosaljiLink{

    public static function PosaljiLink($email){

        $ev=EmailVerifikacija::get();
        
        $token="";
        
        do {
            $token=Str::random(100);
        } while ($ev->firstWhere('token', $token)!=null);
        $emailVerifikacija=EmailVerifikacija::Create([
            "email"=> $email,
            "aktivan"=>1,
            "token"=>$token
        ]);

        $link=action([\App\Http\Controllers\Auth\RegisterController::class, 'emailVerifikacija'], ['token' => $token]);
            
            Mail::to($email)->send(new EmailVerifikacije($link));
    }
    public static function ValidirajEmail($token){

        $prije5min= Carbon::now()->addMinute(-5);
    
        $ev=EmailVerifikacija::where("token","=",$token)
        ->where("aktivan","=",1)
        ->where("created_at",">", $prije5min)
        ->first();
      // dd($ev);
        if($ev==null){
            
            return 'Greška, pokušajte ponovo.';
        }
        else{
        $user= User::where('email','=',$ev->email)->first();
        $user->email_verified_at=Carbon::now();
        $user->save();
            $ev->aktivan=0;
            $ev->save();
        return 'Uspješna verifikacija email-a, sada se možete logirati.';

        }
    }
    public static function ProvjeriEmail($email){

        $user= User::where('email','=',$email)->first();
        if ($user)
        if($user->email_verified_at!=null){
               
          return true;

        }
        return false;
    }
}