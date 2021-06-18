<?php

namespace App\Http\Controllers;
use Session;
use App\Models\NarudzbaPodaci;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CaptchaServiceController extends Controller
{
    public function index()
    {
        
       
        return view('captcha.index');
        
    }
    public function CreateTelefon()
    {
        
       
        return view('captcha.telefonKood');
        
    }
    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telefon' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $oldNarudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
        $narudzbaPodaci= new NarudzbaPodaci($oldNarudzbaPodaci);
        $telefonV='1234';//generisati random br i poslati poruku na mob.
        $narudzbaPodaci->edit($request->get('email'),$request->get('telefon'),$telefonV);
        $request->session()->put('narudzbaPodaci',$narudzbaPodaci);
        return redirect()->route('CreateTelefon');
    }

    public function TelefonValidate(Request $request)
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
