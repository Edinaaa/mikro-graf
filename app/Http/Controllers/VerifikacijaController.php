<?php

namespace App\Http\Controllers;
use Session;
use App\Models\NarudzbaPodatci;
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

        $oldNarudzbaPodaci=Session::has('narudzbaPodatci')? Session::get('narudzbaPodatci'):null;
        $narudzbaPodatci= new NarudzbaPodatci($oldNarudzbaPodaci);

       $telefonV=rand(1000,10000);
            try {
                $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"),getenv("NEXMO_SECRET"));
                $client = new \Nexmo\Client($basic);

                $receiverNumber =$request->get('telefon');
                $message = $telefonV;
                $message = $client->message()->send([
                    'to' => $receiverNumber,
                    'from' => 'mikro-graf',
                    'text' => $message]);
            }
            catch (Exception $e) {
                $request->session()->flash('alert-warning',$e->getMessage());
            }
        $narudzbaPodatci->edit($request->get('email'),$request->get('telefon'),$telefonV);
        $request->session()->put('narudzbaPodatci',$narudzbaPodatci);
        //return redirect()->route('telefonForm');
        return view('captcha.telefonKood');
    }

    public function TelefonVerifikacija(Request $request)
    {
        $oldNarudzbaPodaci=Session::has('narudzbaPodatci')? Session::get('narudzbaPodatci'):null;
        $narudzbaPodatci= new NarudzbaPodatci($oldNarudzbaPodaci);
        $telefonv=$narudzbaPodatci->telefonv;
        $request->validate([
            'verifikacioni_code' => 'required|in:'.$telefonv,
        ]);
        $jednaki=$narudzbaPodatci->TelefonKood($request->get('verifikacioni_code'));

        if($jednaki){
            return redirect()->action([NarudzbaController::class, 'NarudzbaGost']);
        }
        $request->session()->flash('alert-warning','Verifikacijski kood nije ispravan.');
        return view('captcha.telefonKood');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
