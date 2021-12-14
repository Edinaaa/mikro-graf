<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Oblik;
use App\Http\Requests;
use Image;
use File;
use App\Helper\Slike;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OblikController extends Controller
{
    public function create()
    {
        $oblici =Oblik::latest()->with('image')->paginate(6);
        return view('oblik.oblik',['oblici'=>$oblici]);
    }

    public function show(Oblik $oblik){
        return view('oblik.oblikUpdate',['oblik'=>$oblik]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "naziv"=>'required|max:30',
            'file' => 'image|mimes:jpeg,bmp,png' 

        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $oblik=Oblik::find($id);
                $imagedb=null;
                if ($request->hasFile('file')) {
                    $id=Slike::DodajSliku($request->file('file'));
                    $imagedb=Images::find($id);
                    
                }

                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $oblik->naziv=$request->get('naziv');
                $oblik->aktivan=$aktivan;
                $oblik->save();
                if($imagedb){

                    $image=Images::get()->find($oblik->images_id);
                    $oblik->images_id =$imagedb->id;
                    $oblik->save();
                    $id=Slike::IzbrisiSliku($image);
                }
                
                $request->session()->flash('alert-success', 'Uspješno izmjenjen oblik.');
            
                return redirect()->route('oblik');
            }
        } 
        $request->session()->flash('alert-warning','Za to akciju nemate privilegije.');
        return redirect()->route('oblik');

    }
    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required|max:30',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);

        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                if ($request->hasFile('file')) {

                    $id=Slike::DodajSliku($request->file('file'));
                    $imagedb=Images::find($id);

                    $aktivan=false;
                    if($request->has('aktivan')){
                        $aktivan=true;
                    }

                    Oblik::create([
                            "naziv" =>$request->get('naziv'),
                            "images_id" => $imagedb->id,
                            "aktivan"=>$aktivan,
                            "kreirao_id" =>auth()->id()]); 
                }
                
                $request->session()->flash('alert-success', 'Uspješno dodan oblik.');
            
                return back();
            }
        } 
        $request->session()->flash('alert-warning','Za to akciju nemate privilegije.');
        return back();

    }
    public function destroy(Oblik $oblik){
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $image=Images::get()->find($oblik->images_id);
                $oblik->delete();
                $id=Slike::IzbrisiSliku($image);
  

            }
        }

        return back();

    }
}
