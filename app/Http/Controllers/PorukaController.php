<?php

namespace App\Http\Controllers;
use App\Models\Razgovor;
use App\Models\Poruka;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PorukaController extends Controller
{
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
           
            'sadrzaj'=>'required',
            
            'razgovor_id',
        ]);

        
        if (Auth::check() ) {
            $request->validate([
               
    
            ]);
           
            $r=Razgovor::find($request->get('razgovor_id'));

            Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'razgovor_id'=>$r->id,
                'posiljaoc_id'=>auth()->id()]);

        }

        else{
            $request->validate([
                'email'=>'required|email|max:255',
    
            ]);
            $r=Razgovor::find($request->get('razgovor_id'));
            Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'email'=>$request->get('email'),
                'razgovor_id'=>$r->id]);
        
        }
    
        return back();
    }
}
