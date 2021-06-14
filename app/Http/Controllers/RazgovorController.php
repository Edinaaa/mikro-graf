<?php

namespace App\Http\Controllers;
use App\Models\Razgovor;
use App\Models\Poruka;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RazgovorController extends Controller
{
    public function poruke()
    {
       
        if(Auth::check())
        {
            if(auth()->user()->hasRole('admin')){
                $primaoci=User::where('id','<>',auth()->id())->get();

            }
            else{
                $primaoci = DB::table('users')
                    ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
                    ->join('roles', 'users_roles.role_id', '=', 'roles.id')
                    ->where('roles.name','=','admin')
                    ->select('users.id','users.name','users.lastname')
                    ->get();
            }
        
        return view('komunikacija.poruke',['primaoci'=>$primaoci]);
        }
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
                with('poruke')->first();
            }

        return view('komunikacija.razgovori',['razgovori'=>$razgovori,'odabraniRazgovor'=>$odabraniRazgovor]);
        }
        return view('auth.register');

    }

   
    public function store(Request $request)
    {
        dd($request);

        // Validate the inputs
        $request->validate([
            'tema'=>'required',
            'sadrzaj'=>'required',

        ]);

        
        if (Auth::check() ) {
            $request->validate([
               
                'primaoc_id'=>'required',
    
            ]);
            Razgovor::create([
                'tema'=>$request->get('tema'),
                'primaoc_id'=> $request->get('primaoc_id'),
                'posiljaoc_id'=>auth()->id()]);

            $r=Razgovor::where('tema','=',$request->get('tema'))->
            where('posiljaoc_id','=',auth()->id())->latest()->first();

            Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'razgovor_id'=>$r->id,
                'posiljaoc_id'=>auth()->id()]);
                return redirect()->route('razgovor', ['id' => $r->id]);

        }

        else{
            $request->validate([
                'email'=>'required|email|max:255',
    
            ]);
            $role=Role::where('name','=','Admin')->with('users')->first();

            $users = DB::table('users')
            ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->join('roles', 'users_roles.role_id', '=', 'roles.id')
            ->where('roles.name','=','admin')
            ->select('users.id')
            ->get();
            Razgovor::create([
                'tema'=>$request->get('tema'),
                'email'=>$request->get('email'),
                'primaoc_id'=>$users[0]->id]);

            $r=Razgovor::where('tema','=',$request->get('tema'))->
            where('email','=',$request->get('email'))->latest()->first();

            Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'email'=>$request->get('email'),
                'razgovor_id'=>$r->id]);
        
        }
        return back();
    }
}
