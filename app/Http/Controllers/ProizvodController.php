<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Proizvod;
use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProizvodController extends Controller
{
    public function create()
    {
        $oblici =Oblik::latest()->with('image')->paginate(6);
        $fontovi =Font::latest()->with('image')->paginate(6);
        $materijali =Materijal::latest()->with('image')->paginate(6);
        $proizvodi =Proizvod::latest()->with(['image','font','oblik','materijal'])->paginate(6);
        return view('proizvodi.proizvodi',['proizvodi'=>$proizvodi,'oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali]);
    }
    public function show(Proizvod $proizvod){

        return view('proizvodi.show',['proizvod'=>$proizvod]);
    }
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'naziv'=>'required',
            'visina'=>'required',
            'sirina'=>'required',
            'cijena'=>'required',
            'popust'=>'required',
            'novo'=>'required',
            'font_id'=>'required',
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
               

                if($request->naziv=="Plocica za vrata"){
                    $request->validate([
                        'oblik_id'=>'required',
                    ]);
                    Proizvod::create([
                        'naziv'=>$request->get('naziv'),
                        'visina'=>$request->get('visina'),
                        'sirina'=>$request->get('sirina'),
                        'cijena'=>$request->get('cijena'),
                        'popust'=>$request->get('popust'),
                        'novo'=>$request->get('novo'),
                        'obliks_id'=>$request->get('oblik_id'),
                        'fonts_id'=>$request->get('font_id'),
                        'materijals_id'=>$request->get('materijal_id'),
                        "images_id" => $imagedb->id,
                        "kreirao_id" =>auth()->id()]);
                }
                else{
                    Proizvod::create([
                            'naziv'=>$request->get('naziv'),
                            'visina'=>$request->get('visina'),
                            'sirina'=>$request->get('sirina'),
                            'cijena'=>$request->get('cijena'),
                            'popust'=>$request->get('popust'),
                            'novo'=>$request->get('novo'),
                            'fonts_id'=>$request->get('font_id'),
                            'materijals_id'=>$request->get('materijal_id'),
                            "images_id" => $imagedb->id,
                            "kreirao_id" =>auth()->id()]);
                    
                   
                } 
                
            }
        
            
           
        
        }
    
        return back();
    }
    public function destroy(Proizvod $proizvod){
        
          $image=Images::get()->find($proizvod->images_id);
          $proizvod->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
         //unlink($filename);
          $image->delete();   

        return back();
    }
}
