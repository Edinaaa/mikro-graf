<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Proizvod;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;

class ProizvodController extends Controller
{
    public function create()
    {
        $proizvodi =Proizvod::latest()->with('image')->paginate(6);
        return view('proizvodi.proizvodi',['proizvodi'=>$proizvodi]);
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'naziv'=>'required',
            'visina'=>'required',
            'sirina'=>'required',
            'cijena'=>'required',
            'fonts_id'=>'required',
            'materijals_id'=>'required',
            'images_id'=>'required',
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
            Priuzvod::create([
                'naziv'=>$request->get('naziv'),
                'visina'=>$request->get('visina'),
                'sirina'=>$request->get('sirina'),
                'cijena'=>$request->get('cijena'),
                'popust'=>$request->get('popust'),
                'novo'=>$request->get('novo'),
                'obliks_id'=>$request->get('obliks_id'),
                'fonts_id'=>$request->get('fonts_id'),
                'materijals_id'=>$request->get('materijals_id'),
                "images_id" => $imagedb->id,
                 "kreirao_id" =>auth()->id()]);
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
