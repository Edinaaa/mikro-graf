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
        $proizvodi =Proizvod::latest()->with(['image','font','oblik','materijal'])->paginate(6);
        return view('proizvodi.proizvodi',['proizvodi'=>$proizvodi,'oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'artikli'=>$artikli]);
    }

    public function show(Proizvod $proizvod){
        $pproizvod =Proizvod::latest()->with(['image','font','oblik','materijal','artikal'])->get();
        return view('proizvodi.show',['proizvod'=>$proizvod]);
    }

    public function SelektAdd(Request $request,$id){
        dd($id);
        $proizvod=Proizvod::find($id);
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->add($proizvod, $proizvod->id);
       $request->session()->put('cart',$cart);
        return redirect()->route('proizvodi');
    }

    public function update(Request $request, $id)
    {
        $proizvod=Proizvod::find($id);

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
        else{
            $imagedb= Images::find($proizvod->images_id);

        }

        if (Auth::check() ) {
               
            if(auth()->user()->hasRole('admin')){
                $proizvod->tekst=$request->get('tekst');
                $proizvod->visina=$request->get('visina');
                $proizvod->sirina=$request->get('sirina');
                $proizvod->cijena=$request->get('cijena');
                $proizvod->popust=$request->get('popust')?$request->get('popust'):null;
                $proizvod->novo=false;//$request->get('novo');
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
                    'popust'=>$request->get('popust')?$request->get('popust'):null,
                    'novo'=>false,//$request->get('novo'),
                    'obliks_id'=>$request->get('oblik_id')?$request->get('oblik_id'):null,
                    'artikals_id'=>$request->get('artikal_id'),
                    'aktivan'=>true,
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
        /*  $image=Images::get()->find($proizvod->images_id);
          $proizvod->delete();
          $filename=$image->file_path.'/'.$image->name;
          File::delete($filename);
         //unlink($filename);
          $image->delete();   
*/
        return back();
    }
}
