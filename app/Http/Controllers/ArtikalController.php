<?php

namespace App\Http\Controllers;
use App\Models\Artikal;
use App\Models\Materijal;
use App\Models\Artikal_materijals;


use App\Http\Requests;
use Session;
use App\Models\SelektovaniMaterijali;
use Illuminate\Http\Request;

class ArtikalController extends Controller
{
    public function create()
    {
        $artikli =Artikal::latest()->paginate(10);
        $materijali =Materijal::get();

        return view('artikal.artikal',['artikli'=>$artikli,'materijali'=>$materijali]);
    }
    public function show(Artikal $artikal){
        return view('artikal.update',['artikal'=>$artikal]);
    }
    public function update(Request $request, $id)
    {
        $artikal=Artikal::find($id);
     

           $aktivan=false;
           if($request->has('aktivan')){
               $aktivan=true;
           }
           $artikal->naziv=$request->get('naziv');
           $artikal->aktivan=$aktivan;
           $artikal->save();
           
        
           $request->session()->flash('alert-success', 'Uspjesno izmjenjen artikal.');
    
           return redirect()->route('artikal');
    }
    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required',

        ]);

       
        $aktivan=false;
        if($request->has('aktivan')){
            $aktivan=true;
        }
        
           $artikal= Artikal::create([
                    "naziv" =>$request->get('naziv'),
                    "aktivan"=>$aktivan,
                    "kreirao_id" =>auth()->id()]);

                $oldmaterijali=Session::has('materijali')? Session::get('materijali'):null;
                $ms= new SelektovaniMaterijali($oldmaterijali);
            if($ms && $ms->items!=null){
                
                foreach($ms->items as $m)
                {
                    
                    Artikal_materijals::create([
                        'artikals_id'=>$artikal->id,
                        'materijals_id'=>$m->id]);

                }

            }
            Session::forget('materijali');

            $request->session()->flash('alert-success', 'Uspjesno dodan artikal.');
    
        return back();
    }
    public function destroy(Artikal $artikal){
        
          $artikal->delete();
        

        return back();
    }
}
