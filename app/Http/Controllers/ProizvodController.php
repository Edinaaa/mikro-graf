<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Proizvod;
use App\Models\Kategorija;

use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Models\Cart;
use Session;
use App\Http\Requests;
use Image;
use File;
use App\Helper\Slike;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ProizvodController extends Controller
{
    public function create()
    {
        $oblici =Oblik::latest()->with('image')->paginate(6);
        $kategorije =Kategorija::latest()->paginate(10);

        $fontovi =Font::latest()->with('image')->paginate(6);
        $materijali =Materijal::latest()->with('image')->paginate(6);
        $proizvodi =null;
        if(Auth::Check()){
            if(auth()->user()->hasRole('admin')){
                $proizvodi =Proizvod::latest()->with(['image','font','oblik','materijal'])->paginate(6);

            }
            else{
                 $proizvodi =Proizvod::latest()->where('aktivan','=','1')->with(['image','font','oblik','materijal'])->paginate(6);

            }
        }
        else{
            $proizvodi =Proizvod::latest()->where('aktivan','=','1')->with(['image','font','oblik','materijal'])->paginate(6);

        }
        return view('proizvodi.proizvodi',['proizvodi'=>$proizvodi,'oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'kategorije'=>$kategorije]);
    }
    public function show(Proizvod $proizvod){
       $oblici =Oblik::latest()->with('image')->paginate(6);
       $kategorije =Kategorija::latest()->paginate(10);
       $fontovi =Font::latest()->with('image')->paginate(6);
       $materijali =Materijal::latest()->with('image')->paginate(6);
        return view('proizvodi.show',['proizvod'=>$proizvod,'oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'kategorije'=>$kategorije]);
    }
    public function update(Request $request, $id)
    {
        $proizvod=Proizvod::find($id);
        $request->validate([
            'tekst'=>'max:200',
            "visina"=>'required|between:0,9999.99',
            "sirina"=>'required|between:0,9999.99',
            'file' => 'image|mimes:jpeg,bmp,png' ,
            'cijena'=>'required|between:0,9999.99',
            'kategorija_id'=>'required|integer',
            'materijal_id'=>'required|integer',
        ]);
        $aktivan=false;
        if($request->has('aktivan')){
            $aktivan=true;
        }
       
        $novi=false;
        $popust=0;
        if($aktivan)
       {
            if($request->has('novo')){
                $novi=true;
            }
           
        //ako je novi proizvod nema popusta, i obratno ako ima popust nije novi
            if(!$novi){
                $popust=$request->get('popust')?$request->get('popust'):0;
            }
       }
       $oblik_id=null;
       if($request->get('oblik_id'))
       {
            $request->validate(['oblik_id'=>'required|integer']);
            $oblik_id=$request->get('oblik_id');
       } 
       $font=null;
        if($request->get('font_id')!=""){
            $request->validate(['font_id'=>'integer']);
            $font=$request->get('font_id');
        }
        $imagedb= null;
        if ($request->hasFile('file')) {

            $id=Slike::DodajSliku($request->file('file'));
            $imagedb=Images::find($id);
        }

        if (Auth::check() ) {
               
            if(auth()->user()->hasRole('admin')){
                $proizvod->tekst=$request->get('tekst')?$request->get('tekst'):"";
                $proizvod->visina=$request->get('visina');
                $proizvod->sirina=$request->get('sirina');
                $proizvod->cijena=$request->get('cijena');
                $proizvod->popust=$popust;
                $proizvod->novo=$novi;
                $proizvod->aktivan=$aktivan;
                $proizvod->obliks_id=$oblik_id;
                $proizvod->kategorijas_id=$request->get('kategorija_id');
                $proizvod->fonts_id=$font;
                $proizvod->materijals_id=$request->get('materijal_id');
                $proizvod->save();

                if($imagedb){
                    $image=Images::get()->find($proizvod->images_id);
                    $proizvod->images_id=$imagedb->id;
                    $proizvod->save();
                    $id=Slike::IzbrisiSliku($image);
                }
                $request->session()->flash('alert-success', 'Uspjesno izmjenjen proizvod.');
                return redirect()->route('proizvodi');
            
            }
        
        }
        $request->session()->flash('alert-warning','Za to akciju nemate privilegije.');
    
        return redirect()->route('proizvodi');
    }
    public function store(Request $request)
    {
        $aktivan=false;
        if($request->has('aktivan')){
            $aktivan=true;
        }
        $novi=false;
        if($request->has('novo')){
            $novi=true;
        }
        $oblik_id=null;
        if($request->get('oblik_id'))
        {
             $request->validate(['oblik_id'=>'required|integer']);
             $oblik_id=$request->get('oblik_id');
        } 
        $popust=0;//ako je novi proizvod nema popusta, i obratno ako ima popust nije novi
        if(!$novi && $request->get('popust')!=""){
            $request->validate(['popust'=>'integer']);
            $popust=$request->get('popust');
        }
        $font=null;
        if($request->get('font_id')!=""){
            $request->validate(['font_id'=>'integer']);
            $font=$request->get('font_id');
        }
        // Validate the inputs
        $request->validate([
            'tekst'=>'max:200',
            "visina"=>'required|between:0,9999.99',
            "sirina"=>'required|between:0,9999.99',
            'file' => 'required|image|mimes:jpeg,bmp,png' ,
            'cijena'=>'required|between:0,9999.99',
            'kategorija_id'=>'required|integer',
            'materijal_id'=>'required|integer',
        ]);
        $imagedb=null;
        if ($request->hasFile('file')) {

            $id=Slike::DodajSliku($request->file('file'));
            $imagedb=Images::find($id);
        }
        $images_id=$imagedb? $imagedb->id:null;
          
        if (Auth::check() ) {
            if(auth()->user()->hasRole('admin')){
                Proizvod::create([
                    'tekst'=>$request->get('tekst')?$request->get('tekst'):"",
                    'visina'=>$request->get('visina'),
                    'sirina'=>$request->get('sirina'),
                    'cijena'=>$request->get('cijena'),
                    'popust'=>$popust,
                    'novo'=>$novi,
                    'obliks_id'=>$oblik_id,
                    'kategorijas_id'=>$request->get('kategorija_id'),
                    'aktivan'=>$aktivan,
                    'fonts_id'=>$font,
                    'materijals_id'=>$request->get('materijal_id'),
                    "images_id" => $imagedb->id,
                    "kreirao_id" =>auth()->id()
                ]);
            
                $request->session()->flash('alert-success', 'Uspjesno dodan proizvod.');
                return back();
            }
        }  
        $request->session()->flash('alert-warning','Za to akciju nemate privilegije.');
        
        return back();
    }
    public function destroy(Proizvod $proizvod){
   
         $image=Images::get()->find($proizvod->images_id);
          $proizvod->delete();
          $id=Slike::IzbrisiSliku($image);
 

        return redirect()->route('proizvodi');

    }
}
