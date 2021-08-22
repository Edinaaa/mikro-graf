<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Galerija;
use App\Http\Requests;
use Image;
use File;
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

                $galerija->name=$request->get('naziv');
                $galerija->save();
                if($imagedb!=null){

                    $image=Images::get()->find($galerija->images_id);
                    $galerija->images_id=$imagedb->id;
                    $galerija->save();
                    $filename=$image->file_path.'/'.$image->name;
                    File::delete($filename);
                    $image->delete();
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
                $filename=$image->file_path.'/'.$image->name;
                File::delete($filename);
                //unlink($filename);
                $image->delete();   

            }
        } 
        return back();

    }
}
