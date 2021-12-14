<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Font;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\Slike;


class FontController extends Controller
{
    public function create(){
        $fontovi =Font::latest()->with('image')->paginate(6);
        return view('font.font',['fontovi'=>$fontovi]);
    }
    public function show(Font $font){
         return view('font.fontUpdate',['font'=>$font]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "naziv"=>'required|max:30',
            'file' => 'image|mimes:jpeg,bmp,png' 

        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
            $font=Font::find($id);
            $imagedb=null;
                if ($request->hasFile('file')) {
                   
                    $id=Slike::DodajSliku($request->file('file'));
                    $imagedb=Images::find($id);
                  
                }

                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $font->naziv=$request->get('naziv');
                $font->aktivan=$aktivan;
                $font->save();
                if($imagedb){


                    $image=Images::get()->find($font->images_id);

                    $font->images_id =$imagedb->id;
                    $font->save();
                    $id=Slike::IzbrisiSliku($image);
                    
                    
                }
            
                $request->session()->flash('alert-success', 'Uspjesno izmjenjen font.');
        
                return redirect()->route('font');
            }
        }
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');
        
        return redirect()->route('font');
    }

    public function store(Request $request){
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
                    Font::create([
                            "naziv" =>$request->get('naziv'),
                            "images_id" => $imagedb->id,
                            "aktivan"=>$aktivan,
                            "kreirao_id" =>auth()->id()]);
                }
                $request->session()->flash('alert-success', 'Uspjesno dodan font.');
                return back();
            }
           
        }

        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');
        return back();
    }
   
}
