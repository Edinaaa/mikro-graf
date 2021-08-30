<?php

namespace App\Http\Controllers;
use Session;
use App\Models\NarudzbaPodaci;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Exception;

class VerifikacijaController extends Controller
{
    public function contactForm()
    {
       
       
        return view('captcha.index');
        
    }
    public function telefonForm()
    {
        
       
        return view('captcha.telefonKood');
        
    }
  
    public function contactCaptchaVerifikacija(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telefon' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $oldNarudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
        $narudzbaPodaci= new NarudzbaPodaci($oldNarudzbaPodaci);

       $telefonV=rand(1000,10000);
       //$request->session()->flash('alert-warning', 'code: '.$telefonV);

       
            try {

                $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));

                $client = new \Nexmo\Client($basic);

    

                $receiverNumber =$request->get('telefon');

                $message = $telefonV;

    

                $message = $client->message()->send([

                    'to' => $receiverNumber,

                    'from' => 'mikro-graf',

                    'text' => $message

                ]);

    

              // dd('SMS Sent Successfully.');

                

            }
            catch (Exception $e) {

                $request->session()->flash('alert-warning',$e->getMessage());

            

            }
        
        
        
        $narudzbaPodaci->edit($request->get('email'),$request->get('telefon'),$telefonV);
        $request->session()->put('narudzbaPodaci',$narudzbaPodaci);
        return redirect()->route('telefonForm');
    }

    public function TelefonVerifikacija(Request $request)
    {
        

        $oldNarudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
        $narudzbaPodaci= new NarudzbaPodaci($oldNarudzbaPodaci);
        $telefonv=$narudzbaPodaci->telefonv;
        $request->validate([
            'verifikacioni_code' => 'required|in:'.$telefonv,
           
        ]);
        $jednaki=$narudzbaPodaci->TelefonKood($request->get('verifikacioni_code'));

        if($jednaki){
            return redirect()->action([NarudzbaController::class, 'NarudzbaGost']);

        }
        return view('captcha.telefonKood');
    }
    public function reloadCaptcha()
    {
       
        return response()->json(['captcha'=> captcha_img()]);

    }
}
