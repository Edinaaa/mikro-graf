<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Proizvod;
use App\Models\Artikal;

use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Models\Cart;
use Session;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ProizvodController extends Controller
{
    public function create()
    {
        $oblici =Oblik::latest()->with('image')->paginate(6);
        $artikli =Artikal::latest()->paginate(10);

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
        return view('proizvodi.proizvodi',['proizvodi'=>$proizvodi,'oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'artikli'=>$artikli]);
    }

    public function show(Proizvod $proizvod){
      //  $p =Proizvod::where('id','=',$proizvod->id)->where('aktivan','=','true')->with(['image','font','oblik','materijal'])->first();

        return view('proizvodi.show',['proizvod'=>$proizvod]);
    }

   

    public function update(Request $request, $id)
    {
      

        $proizvod=Proizvod::find($id);
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
        if($proizvod==null){
            return back();
        }
        $imagedb= null;
        if ($request->hasFile('file')) {

            $image = $request->file('file');
             $input['imagename'] = time().'.'.$image->extension();
     
            $filePath = public_path('/images');

            $img = Image::make($image->path());
            $img->resize(430, 720, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($filePath.'/'.$input['imagename']);

            Images::create([
                "name" => $input['imagename'],
                "file_path" =>  $filePath]);
       
            $imagedb= Images::get()->where( 'name', '=', $input['imagename'])->first();
        }
       

        if (Auth::check() ) {
               
            if(auth()->user()->hasRole('admin')){
                $proizvod->tekst=$request->get('tekst');
                $proizvod->visina=$request->get('visina');
                $proizvod->sirina=$request->get('sirina');
                $proizvod->cijena=$request->get('cijena');
                $proizvod->popust=$popust;
                $proizvod->novo=$novi;
                $proizvod->aktivan=$aktivan;
                $proizvod->obliks_id=$request->get('oblik_id')?$request->get('oblik_id'):null;
                $proizvod->artikals_id=$request->get('artikal_id');
                $proizvod->fonts_id=$request->get('font_id');
                $proizvod->materijals_id=$request->get('materijal_id');
                if($imagedb!=null){
                    $image=Images::get()->find($proizvod->images_id);
                    $proizvod->images_id=$imagedb->id;
                    $proizvod->save();
                    $filename=$image->file_path.'/'.$image->name;
                    File::delete($filename);
                    $image->delete();
                    

                }
                $proizvod->save();
            }
        
        }
    
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
        $popust=0;//ako je novi proizvod nema popusta, i obratno ako ima popust nije novi
        if(!$novi){
            $popust=$request->get('popust')?$request->get('popust'):0;
        }
        // Validate the inputs
        $request->validate([
            'tekst'=>'required',
            'visina'=>'required',
            'sirina'=>'required',
            'cijena'=>'required',
            'font_id'=>'required',
            'artikal_id'=>'required',
            'materijal_id'=>'required',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);

        if ($request->hasFile('file')) {

            
            $image = $request->file('file');
             $input['imagename'] = time().'.'.$image->extension();
     
            $filePath = public_path('/images');


            $img = Image::make($image->path());
            $img->resize(430, 720, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($filePath.'/'.$input['imagename']);

            Images::create([
                "name" => $input['imagename'],
                "file_path" =>  $filePath]);
       
            $imagedb= Images::get()->where( 'name', '=', $input['imagename'])->first();
            if (Auth::check() ) {
               
                Proizvod::create([
                    'tekst'=>$request->get('tekst'),
                    'visina'=>$request->get('visina'),
                    'sirina'=>$request->get('sirina'),
                    'cijena'=>$request->get('cijena'),
                    'popust'=>$popust,
                    'novo'=>$novi,
                    'obliks_id'=>$request->get('oblik_id')?$request->get('oblik_id'):null,
                    'artikals_id'=>$request->get('artikal_id'),
                    'aktivan'=>$aktivan,
                    'fonts_id'=>$request->get('font_id'),
                    'materijals_id'=>$request->get('materijal_id'),
                    "images_id" => $imagedb->id,
                    "kreirao_id" =>auth()->id()]);
                
                
            }
        
            
           
        
        }
    
        return back();
    }
    public function destroy(Proizvod $proizvod){
        
        $proizvod=Proizvod::find($proizvod->id);
        $proizvod->aktivan=false;
        $proizvod->novo=false;
        $proizvod->popust=false;

        $proizvod->save();
        /*  $image=Images::get()->find($proizvod->images_id);
          $proizvod->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
         //unlink($filename);
          $image->delete();   
*/
return redirect()->route('proizvodi');

    }
}
