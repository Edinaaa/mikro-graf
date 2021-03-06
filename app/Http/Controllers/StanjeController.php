<?php

namespace App\Http\Controllers;
use App\Models\Stanje;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StanjeController extends Controller
{
    public function create()
    {
        $stanja =Stanje::latest()->paginate(10);
        return view('stanje.stanje',['stanja'=>$stanja]);
    }

    public function show(Stanje $stanje){
        return view('stanje.stanjeUpdate',['stanje'=>$stanje]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "naziv"=>'required|max:30',

        ]);
        if(Auth::check())
        {
            if(auth()->user()->hasRole('admin')){
                $stanje=Stanje::find($id);
                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $stanje->naziv=$request->get('naziv');
                $stanje->aktivan=$aktivan;
                $stanje->save();
                
                $request->session()->flash('alert-success', 'Uspješno izmjenjeno stanje.');
                return redirect()->route('stanje');
            }
        }
        $request->session()->flash('alert-warning','Za ovu akciju nemate privilegije.');
        return redirect()->route('stanje');
     
    }
    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required|max:30',

        ]);
        if(Auth::check())
        {
            if(auth()->user()->hasRole('admin')){
                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                
                stanje::create([
                        "naziv" =>$request->get('naziv'),
                        "aktivan"=>$aktivan,
                        "kreirao_id" =>auth()->id()]);
        
                $request->session()->flash('alert-success', 'Uspješno dodano stanje.');
                return back();
            }
        }
        $request->session()->flash('alert-warning','Za ovu akciju nemate privilegije.');
        return back();

    }
    public function destroy(Stanje $stanje){
        
          $stanje->delete();
        

        return back();
    }
}
