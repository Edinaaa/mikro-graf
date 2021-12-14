<?php

namespace App\Http\Controllers;
use App\Models\Razgovor;
use App\Models\Poruka;
use App\Models\User;
use App\Models\Role;
use Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RazgovorController extends Controller
{
    public function poruke()
    {
       
        if(Auth::check())
        { 
            $primaoci=null;
            if(auth()->user()->hasRole('admin')){
                $primaoci=User::where('id','<>',auth()->id())->get();

            }
            
        
        return view('komunikacija.poruke',['primaoci'=>$primaoci]);
        }
        $request->session()->flash('alert-info','Registrujte se da bi imali pregled poruka.');

        return view('auth.register');

    }
    public function create($id=0)
    {
        if(Auth::check())
        {
            $razgovori =Razgovor::with('porukezadnje')->latest()->
            where('posiljaoc_id','=',auth()->id())->
            orWhere('primaoc_id','=',auth()->id())->
            get();

            if($id!=0){
            $odabraniRazgovor =Razgovor::
            with('poruke')->find($id);
            }
            else{
                $odabraniRazgovor =Razgovor::
                where('posiljaoc_id','=',auth()->id())->
                orWhere('primaoc_id','=',auth()->id())->
                with(['poruke'])->first();
            }

        return view('komunikacija.razgovori',['razgovori'=>$razgovori,'odabraniRazgovor'=>$odabraniRazgovor]);
        }
        //$request->session()->flash('alert-warning','Registrujte se da bi imali pregled poruka.');

        return view('auth.register');

    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function captchaVerifikacija(Request $request){
        
        $request->validate([
            'captcha' => 'required|captcha'
        ]);

        $email=Session::get('email');
        $sadrzaj=Session::get('sadrzaj');
        $tema=Session::get('tema');

        if($email){

            $users = DB::table('users')
            ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->join('roles', 'users_roles.role_id', '=', 'roles.id')
            ->where('roles.name','=','admin')
            ->select('users.id')
            ->get();
            $r=Razgovor::create([
                'tema'=>$tema,
                'email'=>$email,
                'primaoc_id'=>$users[0]->id]);

        
            Poruka::create([
                'sadrzaj'=>$sadrzaj,
                'email'=>$email,
                'razgovor_id'=>$r->id]);
                $request->session()->flash('alert-success', 'Hvala vam na javljanju.');
        }
        return view('home.home');
    }
   
    public function store(Request $request)
    {
        

        // Validate the inputs
        $request->validate([
            'tema'=>'required|max:100',
            'sadrzaj'=>'required|max:200',

        ]);

        
        if (Auth::check() ) {
            if(auth()->user()->hasRole('admin')){
                $request->validate([
                
                    'primaoc_id'=>'required',
        
                ]);
                $r=Razgovor::create([
                    'tema'=>$request->get('tema'),
                    'primaoc_id'=> $request->get('primaoc_id'),
                    'posiljaoc_id'=>auth()->id()]);

                
                Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'razgovor_id'=>$r->id,
                'posiljaoc_id'=>auth()->id()]);
                return redirect()->route('razgovor', ['id' => $r->id]);
            }
            else{

                $users = DB::table('users')
                ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
                ->join('roles', 'users_roles.role_id', '=', 'roles.id')
                ->where('roles.name','=','admin')
                ->select('users.id')
                ->get();
                $r=Razgovor::create([
                    'tema'=>$request->get('tema'),
                    'primaoc_id'=> $users[0]->id,
                    'posiljaoc_id'=>auth()->id()]);

                
                Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'razgovor_id'=>$r->id,
                'posiljaoc_id'=>auth()->id()]);
                return redirect()->route('razgovor', ['id' => $r->id]);
            }

        }

        else{
            $request->validate([
                'email'=>'required|email|max:191',
                
    
            ]);
           
            $request->session()->put('email',$request->get('email'));
            $request->session()->put('tema',$request->get('tema'));
            $request->session()->put('sadrzaj',$request->get('sadrzaj'));
            return view('kontakt.captchaVerifikacija');

        }
        return back();
    }
}
