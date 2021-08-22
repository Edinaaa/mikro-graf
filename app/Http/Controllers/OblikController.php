<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Oblik;
use App\Http\Requests;
use Image;
use File;
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
                    $image = $request->file('file');
                    $input['imagename'] = time().'.'.$image->extension();
                    $filePath = public_path('/images');
                    $img = Image::make($image->path());
                    $img->resize(400, 400, function ($const) {
                        $const->aspectRatio();
                        $const->upsize();
                    })->save($filePath.'/'.$input['imagename']);

                    $imagedb= Images::create([
                        "name" => $input['imagename'],
                        "file_path" =>  $filePath]);
                    
                }

                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $oblik->naziv=$request->get('naziv');
                $oblik->aktivan=$aktivan;
                $oblik->save();
                if($imagedb!=null){


                $image=Images::get()->find($oblik->images_id);
                $oblik->images_id =$imagedb->id;

                $oblik->save();
                $filename=$image->file_path.'/'.$image->name;
                File::delete($filename);
                $image->delete();
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
                $filename=$image->file_path.'/'.$image->name;
                File::delete($filename);
                $image->delete();   
            }
        }

        return back();

    }
}
