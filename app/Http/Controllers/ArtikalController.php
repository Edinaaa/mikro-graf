<?php

namespace App\Http\Controllers;
use App\Models\Artikal;
use App\Http\Requests;

use Illuminate\Http\Request;

class ArtikalController extends Controller
{
    public function create()
    {
        $artikli =Artikal::latest()->paginate(10);
        return view('artikal.artikal',['artikli'=>$artikli]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required',

        ]);

        
            Artikal::create([
                    "naziv" =>$request->get('naziv'),
                    "kreirao_id" =>auth()->id()]);
    
    
        return back();
    }
    public function destroy(Artikal $artikal){
        
          $artikal->delete();
        

        return back();
    }
}
