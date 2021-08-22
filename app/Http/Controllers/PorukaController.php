<?php

namespace App\Http\Controllers;
use App\Models\Razgovor;
use App\Models\Poruka;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Odgovor;



class PorukaController extends Controller
{
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
           
            'sadrzaj'=>'required|max:200',
            'razgovor_id',
        ]);

        
        if (Auth::check() ) {
          
           
            $r=Razgovor::with('poruke')->find($request->get('razgovor_id'));
         
            $poruka= Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'razgovor_id'=>$r->id,
                'posiljaoc_id'=>auth()->id()]);

            if($r->email!=null && auth()->user()->hasRole('admin'))
            {

                Mail::send('emails.odgovor', ['razgovor' => $r, 'poruka' => $poruka], function ($message) use ($poruka, $r)
                {
                    $message->from('no-reply@mikro-graf.com');
                    $message->to($r->email);
                    $message->subject($r->tema);
                });
               // Mail::to($r->email)->send(new Odgovor($r,$poruka,$r->tema));
                
            }
        }

        else{
            $request->validate([
                'email'=>'required|email|max:191',
    
            ]);
            $r=Razgovor::find($request->get('razgovor_id'));
            Poruka::create([
                'sadrzaj'=>$request->get('sadrzaj'),
                'email'=>$request->get('email'),
                'razgovor_id'=>$r->id]);
                $request->session()->flash('alert-success', 'Poruka ušpjesno poslana.');
        }
    
        return back();
    }
}
