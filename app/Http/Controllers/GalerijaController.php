<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Galerija;
use App\Http\Requests;
use Image;
use File;
use App\Helper\Slike;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;


class GalerijaController extends Controller
{
    public function create()
    {
       

        $slike =Galerija::latest()->with('image')->paginate(6);
        return view('galerija.galerija',['slike'=>$slike]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "naziv"=>'required|max:30',
            'file' => 'image|mimes:jpeg,bmp,png' 
        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $galerija=  Galerija::find($id);
                $imagedb=null;
                if ($request->hasFile('file')) {

                    $id=Slike::DodajSliku($request->file('file'));
                    $imagedb=Images::find($id);
                }

                $galerija->name=$request->get('naziv');
                $galerija->save();
                if($imagedb){

                    $image=Images::get()->find($galerija->images_id);
                    $galerija->images_id=$imagedb->id;
                    $galerija->save();
                    $id=Slike::IzbrisiSliku($image);
                }
            
                $request->session()->flash('alert-success', 'Uspješno izmjenjena slika.');
            
                return redirect()->route('galerija');
            }
        }
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');

        return redirect()->route('galerija');

    }
    public function show(Galerija $galerija){
        return view('galerija.galerijaUpdate',['galerija'=>$galerija]);
    }
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            "naziv"=>'required|max:30',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                if ($request->hasFile('file')) {
                    $id=Slike::DodajSliku($request->file('file'));
                    $imagedb=Images::find($id);
                    Galerija::create([
                            "name" =>$request->get('naziv'),
                            "images_id" => $imagedb->id,
                            "kreirao_id" =>auth()->id()]);
                }
                $request->session()->flash('alert-success', 'Ušpjesno dodana slika.');
            
                return back();
            }
        }   
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');

        return back();
        
    }
    public function destroy(Galerija $galerija){
        
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $image=Images::get()->find($galerija->images_id);
                $galerija->delete();
                $id=Slike::IzbrisiSliku($image);

            }
        } 
        return back();

    }
}
