<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Korpa;

use App\Models\Images;
use App\Models\Artikal;
use App\Models\Stanje;

use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NarudzbaController extends Controller
{
    public function create(){
        $oblici =Oblik::latest()->with('image')->get();
        $fontovi =Font::latest()->with('image')->get();
        $materijali =Materijal::latest()->with('image')->get();
        $artikli =Artikal::latest()->get();

 
         //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
      // $posts= Posts::get()  ;  vraca sve posts iz baze ::where(),Find()
         //orderBy('created_at','desc') je isto sto latest()
         return view('narudzba.narudzba',['oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'artikli'=>$artikli]);
    }

     public function Pregled(){

         if(Auth::check())
         {
            
             if(auth()->user()->hasRole('admin')){
                $korpe =Korpa::latest()->with(['artikal'])->get();
                
                 $narudzbe =Narudzba::latest()->with(['stanje','user'])->paginate(6);
 
             }
             else{
                $korpe = DB::table('korpas')
                    ->join('narudzbas', 'korpas.narudzbas_id', '=', 'narudzbas.id')
                    ->join('users', 'narudzbas.narucilac_id', '=', 'users.id')
                    ->join('artikals', 'korpas.artikals_id', '=', 'artikals.id')
                    ->where('users.id','=',auth()->id())
                    ->select('artikals.naziv','korpas.narudzbas_id','korpas.kolicina as kolicina')
                    ->get();
             $narudzbe =Narudzba::latest()->where('narucilac_id','=',auth()->id())->with(['stanje'])->paginate(10);
 
             }
 
             return view('narudzba.narudzbe',['narudzbe'=>$narudzbe,'korpe'=>$korpe]);
         }
         else{
             return view('auth.register');
 
         }
     }
 
    
     public function store(Request $request){
 
             // Validate the inputs
             $request->validate([
                 'tekst'=>'required',
                 'visina'=>'required',
                 'sirina'=>'required',
                 'font_id'=>'required',
                 'materijal_id'=>'required',
                 'artikal_id'=>'required',

             ]);
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
            $narudzba=null;
            $stanje=Stanje::where('naziv','=','Naruceno')->first();
            if(Auth::check()){
                $narudzba=Narudzba::create([
                       'narucilac_id' =>auth()->id(),
                       'stanjes_id'=>$stanje->id
                   ]);
                }
            else{
                $request->validate([
                    'email'=>'required',
                    'telefon'=>'required',
                ]);
                $narudzba=Narudzba::create([
                   
                   'email'=>$request->get('email'),
                   'telefon'=>$request->get('telefon'),
                   'stanjes_id'=>$stanje->id
               ]);
            }

            Korpa::create([
                'tekst'=>$request->get('tekst'),
                'visina'=>$request->get('visina'),
                'sirina'=>$request->get('sirina'),
                'opis'=>$request->get('opis'),
                'cijena'=>'0',
                'kolicina'=>1,
                'obliks_id'=>$request->get('oblik_id')? $request->get('oblik_id'):null,
                'fonts_id'=>$request->get('font_id')?$request->get('font_id'):null,
                'materijals_id'=>$request->get('materijal_id'),
                'images_id'=>$imagedb?$imagedb->id:null,
                'narudzbas_id'=>$narudzba->id,
                'artikals_id'=>$request->get('artikals_id')
                ]);
                  
             
           
         return back();
     }
     public function update(Request $request, $id){
 
        // Validate the inputs provjeravati cu da li su null ako nisu update
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $narudzba=Narudzba::find($id);
                if(isset($narudzba)){
                    if($request->get('cijena')!=null )
                        $narudzba->cijena=$request->get('cijena');
                    if($request->get('stanjes_id')!=null ){
                        $stanje=Stanje::find($request->get('stanjes_id'));
                        if($stanje!=null )
                        $narudzba->stanjes_id=$stanje->id;

                    }
                }
                $narudzba->save();
            }
        }
     
        return back();
    }

     public function destroy(){
       /*bez policy
        if(!$objava->ownedBy(auth()->user())){
 
             dd('no');
         }
      //u Objavapolicy smo definisali sta radi delete metoda authorize('delete',
      // prvi parameter se ne preosljeduje, nega dohvati kao trenutno logiranog
         $this->authorize('delete',$objava);//authorize ako ne prodje baca exception 
             $objava->delete();
             return back();*/
     }
 
     public function show(){
 
       /* return view('posts.show',[
 
             'objava'=>$objava
         ]);*/ 
     }
}
