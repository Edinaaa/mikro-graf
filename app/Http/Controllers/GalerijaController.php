<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Galerija;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;

class GalerijaController extends Controller
{
    public function create()
    {
        $slike =Galerija::latest()->with('image')->paginate(6);
        return view('galerija.galerija',['slike'=>$slike]);
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            "galerijaName"=>'required',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);

        // ensure the request has a file before we attempt anything else.
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
            /* 
            https://www.positronx.io/how-to-resize-images-in-laravel-before-uploading/
            
            redi ako se kreira link storage i public 
            $request->file->store('slike', 'public');
            Images::create([
                    "name" =>$request->get('name'),
                    "file_path" => $request->file->hashName()
            ]);
            $imagedb= Images::get()->where('file_path','=',$request->file->hashName())->first();*/

            $imagedb= Images::get()->where( 'name', '=', $input['imagename'])->first();
            Galerija::create([
                    "name" =>$request->get('galerijaName'),
                    "images_id" => $imagedb->id,
                    "kreirao_id" =>auth()->id()]);
        }
    
        return back();
    }
    public function destroy(Galerija $galerija){
        
          $image=Images::get()->find($galerija->images_id);
          $galerija->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
         //unlink($filename);
          $image->delete();   

        return back();
    }
}
