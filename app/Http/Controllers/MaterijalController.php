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

use Illuminate\Support\Facades\Auth;

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
            "naziv"=>'required|max:30',
            "visina"=>'between:0,9999.99',
            "sirina"=>'between:0,9999.99',
            'file' => 'required|image|mimes:jpeg,bmp,png' 

        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $input['imagename'] = time().'.'.$image->extension();
                    $filePath = public_path('/slike');
                    $filePaththumb = public_path('/thumb');


                    $img = Image::make($image->path());
                    $img->save($filePath.'/'.$input['imagename']);

                    $thumb= Image::make($image->path());
                    $thumb->resize(300, 300, function ($const) {
                        $const->aspectRatio();
                        $const->upsize();
                    })->save($filePaththumb.'/'.$input['imagename']);
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
                        "kreirao_id" =>auth()->id()
                    ]);
                    $request->session()->flash('alert-success', 'Uspješno dodan materijal.');
                    return back();
                }
            }
        }  
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');
        return back();
    }

    public function update(Request $request, $id)
    {
        $aktivan=false;
        $request->validate([
            "naziv"=>'required|max:30',
            "visina"=>'between:0,9999.99',
            "sirina"=>'between:0,9999.99',
        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $materijal=Materijal::find($id);
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $imagedb=null;
                if ($request->hasFile('file')) {

                    
                    $image = $request->file('file');
                    $input['imagename'] = time().'.'.$image->extension();
            
                    $filePath = public_path('/slike');
                    $filePaththumb = public_path('/thumb');


                    $img = Image::make($image->path());
                    $img->save($filePath.'/'.$input['imagename']);

                    $thumb= Image::make($image->path());
                    $thumb->resize(300, 300, function ($const) {
                        $const->aspectRatio();
                        $const->upsize();
                    })->save($filePaththumb.'/'.$input['imagename']);
                    $imagedb= Images::create([
                        "name" => $input['imagename'],
                        "file_path" =>  $filePath]);
            
                }
                $materijal->naziv=$request->get('naziv');
                $materijal->visina=$request->get('visina')?$request->get('visina'):0;
                $materijal->sirina=$request->get('sirina')?$request->get('sirina'):0;
                $materijal->aktivan=$aktivan;
                $materijal->save();
                if($imagedb->count()!=0){

                    $image=Images::get()->find($materijal->images_id);
                    $materijal->images_id =$imagedb->id;
                    $materijal->save();
                    
                    $filename=$image->file_path.'/'.$image->name;
                    $filenamethumb=public_path('/thumb').'/'.$image->name;
                    File::delete($filename);
                    File::delete($filenamethumb);
                    $image->delete();
                }
                $request->session()->flash('alert-success', 'Uspješno izmjenjen materijal.');
                return redirect()->route('materijal');
            }
        }
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');

        return redirect()->route('materijal');

    }

}
