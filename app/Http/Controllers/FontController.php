<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Font;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;

class FontController extends Controller
{
    public function create()
    {
        $fontovi =Font::latest()->with('image')->paginate(6);
        return view('font.font',['fontovi'=>$fontovi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);

        if ($request->hasFile('file')) {

            
            $image = $request->file('file');
             $input['imagename'] = time().'.'.$image->extension();
     
            $filePath = public_path('/images');


            $img = Image::make($image->path());
            $img->resize(400, 400, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($filePath.'/'.$input['imagename']);

            Images::create([
                "name" => $input['imagename'],
                "file_path" =>  $filePath]);
     
            $imagedb= Images::get()->where( 'name', '=', $input['imagename'])->first();
            Font::create([
                    "naziv" =>$request->get('naziv'),
                    "images_id" => $imagedb->id,
                    "kreirao_id" =>auth()->id()]);
        }
    
        return back();
    }
    public function destroy(Font $oblik){
        
          $image=Images::get()->find($font->images_id);
          $font->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
          $image->delete();   

        return back();
    }
}
