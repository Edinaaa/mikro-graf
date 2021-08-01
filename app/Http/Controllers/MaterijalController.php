<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Materijal;
use App\Http\Requests;
use Image;
use File;
use Illuminate\Http\Request;
use Session;
use App\Models\SelektovaniMaterijali;


class MaterijalController extends Controller
{
    public function create()
    {
        $materijali =Materijal::latest()->with('image')->paginate(6);
        return view('materijal.materijal',['materijali'=>$materijali]);
    }

    public function show(Materijal $materijal){
        return view('materijal.materijalUpdate',['materijal'=>$materijal]);
    }
    public function selectshow(){
        $materijali =Materijal::latest()->get();
        return view('materijal.selectshow',['materijali'=>$materijali]);
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

            $imagedb= Images::create([
                "name" => $input['imagename'],
                "file_path" =>  $filePath]);
     
                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
            Materijal::create([
                    "naziv" =>$request->get('naziv'),
                    "images_id" => $imagedb->id,
                    "aktivan"=>$aktivan,
                    "visina"=>$request->get('visina')?$request->get('visina'):0,
                    "sirina"=>$request->get('sirina')?$request->get('sirina'):0,
                    "kreirao_id" =>auth()->id()]);
        }
        $request->session()->flash('alert-success', 'Uspjesno dodan materijal.');
        return back();
    }

    public function update(Request $request, $id)
    {
        $materijal=Materijal::find($id);
        $aktivan=false;
        if($request->has('aktivan')){
            $aktivan=true;
        }
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
        $materijal->naziv=$request->get('naziv');
        $materijal->visina=$request->get('visina');
        $materijal->sirina=$request->get('sirina');
        $materijal->aktivan=$aktivan;

        $materijal->save();
        if($imagedb!=null){


                    $image=Images::get()->find($materijal->images_id);
                    $materijal->images_id =$imagedb->id;
        
                    $materijal->save();
                    $filename=$image->file_path.'/'.$image->name;
                    File::delete($filename);
                    $image->delete();
        }
        $request->session()->flash('alert-success', 'Uspjesno izmjenjen materijal.');
        return redirect()->route('materijal');
    }
    public function destroy(Materijal $materijal){
        
          $image=Images::get()->find($materijal->images_id);
          $materijal->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
          $image->delete();   

        return back();
    }
}
