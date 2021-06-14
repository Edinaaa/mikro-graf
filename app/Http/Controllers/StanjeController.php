<?php

namespace App\Http\Controllers;
use App\Models\Stanje;
use App\Http\Requests;
use Illuminate\Http\Request;

class StanjeController extends Controller
{
    public function create()
    {
        $stanja =Stanje::latest()->paginate(10);
        return view('stanje.stanje',['stanja'=>$stanja]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required',

        ]);

        
            Stanje::create([
                    "naziv" =>$request->get('naziv'),
                    "kreirao_id" =>auth()->id()]);
    
    
        return back();
    }
    public function destroy(Stanje $stanje){
        
          $stanje->delete();
        

        return back();
    }
}
