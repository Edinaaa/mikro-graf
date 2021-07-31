<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Korpa;

use App\Models\Images;
use App\Models\Artikal;
use App\Models\Stanje;
use Image;


use App\Mail\NarudzbaIzmjena;
use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Models\Artikal_materijals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Session;
use App\Models\NarudzbaPodaci;

class NarudzbaController extends Controller
{
    public function create(){
        $oblici =Oblik::latest()->where('aktivan','=',1)->with('image')->get();
        $fontovi =Font::latest()->where('aktivan','=',1)->with('image')->get();
        $materijali =Materijal::latest()->where('aktivan','=',1)->with('image')->get();
        $artikal_materijals=DB::table('artikal_materijals')
        ->join('materijals', 'artikal_materijals.materijals_id', '=', 'materijals.id')
        ->where('materijals.aktivan','=',1)
        ->select('artikal_materijals.*')
        ->get();
        $artikli =Artikal::latest()->where('aktivan','=',1)->get();
 
         //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
      // $posts= Posts::get()  ;  vraca sve posts iz baze ::where(),Find()
         //orderBy('created_at','desc') je isto sto latest()
         return view('narudzba.narudzba',['oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'artikli'=>$artikli,'artikal_materijals'=>$artikal_materijals]);
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
                    ->select('artikals.naziv as naziv','korpas.narudzbas_id','korpas.kolicina as kolicina')
                    ->get();
             $narudzbe =Narudzba::latest()->where('narucilac_id','=',auth()->id())->with(['stanje'])->paginate(10);
 
             }
 
             return view('narudzba.narudzbe',['narudzbe'=>$narudzbe,'korpe'=>$korpe]);
         }
         else{
             return view('auth.register');
 
         }
     }
 
   
     public function NarudzbaGost(Request $request ){
 
       $narudzba=null;
       $stanje=Stanje::where('naziv','=','Naruceno')->first();
       if($stanje==null){
           $users = DB::table('users')
           ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
           ->join('roles', 'users_roles.role_id', '=', 'roles.id')
           ->where('roles.name','=','admin')
           ->select('users.id')
           ->get();
           $stanje =Stanje::Create([
               "naziv"=>"Naruceno",
               "aktivan"=>1,
               "kreirao_id"=>$users[0]->id
           ]);

       }
       $Cart=Session::has('cart')? Session::get('cart'):null;

       $narudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
       if($narudzbaPodaci){
           $narudzba=Narudzba::create([
              
              'email'=>$narudzbaPodaci->email,
              'telefon'=>$narudzbaPodaci->telefon,
              'verifikacioni_code'=>$narudzbaPodaci->telefonv,
              'cijena'=>'0',
              'stanjes_id'=>$stanje->id
           ]);
       }
       $imagedb=null;
       if ($narudzbaPodaci->file) {

      
          $image = $narudzbaPodaci->file;
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
      if($narudzbaPodaci->tekst){
        Korpa::create([
            'tekst'=>$narudzbaPodaci->tekst,
            'visina'=>$narudzbaPodaci->visina,
            'sirina'=>$narudzbaPodaci->sirina,
            'opis'=>$narudzbaPodaci->opis,
            'cijena'=>'0',
            'kolicina'=>1, 
            'obliks_id'=>$narudzbaPodaci->obliks_id?$narudzbaPodaci->obliks_id:null,
            'fonts_id'=>$narudzbaPodaci->fonts_id?$narudzbaPodaci->fonts_id:null,
            'materijals_id'=>$narudzbaPodaci->materijals_id,
            'images_id'=>$imagedb?$imagedb->id:null,
            'narudzbas_id'=>$narudzba->id,
            'artikals_id'=>$narudzbaPodaci->artikals_id
         ]);
      }
      elseif($Cart){
        foreach($Cart->items as $korpa)
        { 
                
                Korpa::create([
                    'tekst'=>$korpa['item']->tekst,
                    'visina'=>$korpa['item']->visina,
                    'sirina'=>$korpa['item']->sirina,
                    'opis'=>"",
                    'cijena'=>$korpa['price'],
                    'kolicina'=>$korpa['qty'],
                    'obliks_id'=> $korpa['item']->obliks_id?$korpa['item']->obliks_id:null,
                    'fonts_id'=>$korpa['item']->fonts_id?$korpa['item']->fonts_id:null,
                    'artikals_id'=>$korpa['item']->artikals_id,
                    'proizvods_id'=>$korpa['item']->id,
                    'narudzbas_id'=>$narudzba->id,
                    'images_id'=>$korpa['item']->images_id?$korpa['item']->images_id:null,
                    'materijals_id'=>$korpa['item']->materijals_id,
                   ]);
           
        }
    

        Session::forget('cart');
      }
     

        Session::forget('narudzbaPodaci');
    
        $request->session()->flash('alert-success', 'Hvala na suradnji. O izradi proizvoda biti cete blagovremeno obavjesteni.');
        return redirect()->action([ProizvodController::class, 'create']);
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
            if($stanje==null){
                $users = DB::table('users')
                ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
                ->join('roles', 'users_roles.role_id', '=', 'roles.id')
                ->where('roles.name','=','admin')
                ->select('users.id')
                ->get();
                $stanje =Stanje::Create([
                    "naziv"=>"Naruceno",
                    "aktivan"=>1,
                    "kreirao_id"=>$users[0]->id
                ]);

            }
            if(Auth::check()){
                $narudzba=Narudzba::create([
                       'narucilac_id' =>auth()->id(),
                       'stanjes_id'=>$stanje->id
                   ]);
                }
            else{
                $file =null;
        if ($request->hasFile('file')) {
           $file = $request->file('file');
        }
        $oblik_id=$request->get('oblik_id')? $request->get('oblik_id'):null;
        $oldNarudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
        $narudzbaPodaci= new NarudzbaPodaci($oldNarudzbaPodaci);
        $narudzbaPodaci->add($request->get('tekst'),$request->get('visina'),
        $request->get('sirina'),$request->get('opis'),$oblik_id,
        $request->get('font_id')?$request->get('font_id'):null,
        $request->get('materijal_id'), null, $request->get('artikal_id'));
        $request->session()->put('narudzbaPodaci',$narudzbaPodaci);
        return redirect()->action([CaptchaServiceController::class, 'index']);
          /*      $request->validate([
                    'email'=>'required',
                    'telefon'=>'required',
                ]);
                $narudzba=Narudzba::create([
                   
                   'email'=>$request->get('email'),
                   'telefon'=>$request->get('telefon'),
                   'cijena'=>'0',
                   'stanjes_id'=>$stanje->id
               ]);*/
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
                'artikals_id'=>$request->get('artikal_id')
                ]);
                  
             
           
                return redirect()->route('narudzba.narudzba');
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
                        if($stanje!=null ){
                            $narudzba->stanjes_id=$stanje->id;
                        }

                    }
                }
                $narudzba->save();
                $korpa =Korpa::latest()->where('narudzbas_id','=',$id)->with(['artikal','font','oblik','materijal','image'])->get();
                Mail::to($narudzba->email)->send(new NarudzbaIzmjena($narudzba, $korpa));
           
            }
        }
     
        return redirect()->route('narudzba.narudzbe');
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
 
     public function show(Narudzba $narudzba){
        $stanja=Stanje::get();
        return view('narudzba.narudzbaUpdate',['narudzba'=>$narudzba,'stanja'=>$stanja]);
    }
}
