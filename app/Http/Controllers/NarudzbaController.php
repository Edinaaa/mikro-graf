<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Stavke;

use App\Models\Images;
use App\Models\Kategorija;
use App\Models\Stanje;
use Image;


use App\Mail\NarudzbaIzmjena;
use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Models\Kategorija_materijals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Session;
use App\Models\NarudzbaPodaci;

class NarudzbaController extends Controller
{
    //nova narudzba
    public function create(){
        $oblici =Oblik::latest()->where('aktivan','=',1)->with('image')->get();
        $fontovi =Font::latest()->where('aktivan','=',1)->with('image')->get();
        $materijali =Materijal::latest()->where('aktivan','=',1)->with('image')->get();
        $kategorija_materijals=DB::table('kategorija_materijals')
        ->join('materijals', 'kategorija_materijals.materijals_id', '=', 'materijals.id')
        ->where('materijals.aktivan','=',1)
        ->select('kategorija_materijals.*')
        ->get();
        $kategorije =Kategorija::latest()->where('aktivan','=',1)->get();
 
         //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
      // $posts= Posts::get()  ;  vraca sve posts iz baze ::where(),Find()
         //orderBy('created_at','desc') je isto sto latest()
         return view('narudzba.narudzba',['oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali,'kategorije'=>$kategorije,'kategorija_materijals'=>$kategorija_materijals]);
    }
//pregled narudzbi sa stavkama
     public function Pregled(){

         if(Auth::check())
         {
            
             if(auth()->user()->hasRole('admin')){
                $stavke =Stavke::latest()->with(['kategorija'])->get();
                
                 $narudzbe =Narudzba::latest()->with(['stanje','user'])->paginate(6);
 
             }
             else{
                $stavke = DB::table('stavkes')
                    ->join('narudzbas', 'stavkes.narudzbas_id', '=', 'narudzbas.id')
                    ->join('users', 'narudzbas.narucilac_id', '=', 'users.id')
                    ->join('kategorijas', 'stavkes.kategorijas_id', '=', 'kategorijas.id')
                    ->where('users.id','=',auth()->id())
                    ->select('kategorijas.naziv as naziv','stavkes.narudzbas_id','stavkes.kolicina as kolicina')
                    ->get();
             $narudzbe =Narudzba::latest()->where('narucilac_id','=',auth()->id())->with(['stanje'])->paginate(10);
 
             }
 
             return view('narudzba.narudzbe',['narudzbe'=>$narudzbe,'stavke'=>$stavke]);
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
      
      if($narudzbaPodaci->tekst){
        Stavke::create([
            'tekst'=>$narudzbaPodaci->tekst,
            'visina'=>$narudzbaPodaci->visina,
            'sirina'=>$narudzbaPodaci->sirina,
            'opis'=>$narudzbaPodaci->opis,
            'cijena'=>'0',
            'kolicina'=>1, 
            'obliks_id'=>$narudzbaPodaci->obliks_id?$narudzbaPodaci->obliks_id:null,
            'fonts_id'=>$narudzbaPodaci->fonts_id?$narudzbaPodaci->fonts_id:null,
            'materijals_id'=>$narudzbaPodaci->materijals_id,
            'images_id'=>$narudzbaPodaci->images_id,
            'narudzbas_id'=>$narudzba->id,
            'kategorijas_id'=>$narudzbaPodaci->kategorijas_id
         ]);
      }
      elseif($Cart){
        foreach($Cart->items as $korpa)
        { 
                
                Stavke::create([
                    'tekst'=>$korpa['item']->tekst,
                    'visina'=>$korpa['item']->visina,
                    'sirina'=>$korpa['item']->sirina,
                    'opis'=>"",
                    'cijena'=>$korpa['price'],
                    'kolicina'=>$korpa['qty'],
                    'obliks_id'=> $korpa['item']->obliks_id?$korpa['item']->obliks_id:null,
                    'fonts_id'=>$korpa['item']->fonts_id?$korpa['item']->fonts_id:null,
                    'kategorijas_id'=>$korpa['item']->kategorijas_id,
                    'proizvods_id'=>$korpa['item']->id,
                    'narudzbas_id'=>$narudzba->id,
                    'images_id'=>$korpa['item']->images_id?$korpa['item']->images_id:null,
                    'materijals_id'=>$korpa['item']->materijals_id,
                   ]);
           
        }
    
        
        $narudzba->cijena=$Cart->totalprc;
        $narudzba->save();

        Session::forget('cart');
      }
     

        Session::forget('narudzbaPodaci');
    
        $request->session()->flash('alert-success', 'Hvala na suradnji. O izradi proizvoda biti cete blagovremeno obavjesteni.');
       return view('home.home');
}
     public function store(Request $request){
 
          
          // dd($request);
        $oblik_id=$request->get('oblik_id')? $request->get('oblik_id'):null;
        $font_id=$request->get('font_id')? $request->get('font_id'):null;
        $materijal_id=$request->get('materijal_id')? $request->get('materijal_id'):null;
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
                $Cart=Session::has('cart')? Session::get('cart'):null;

                if($Cart){
                    $narudzba=Narudzba::create([
                        'narucilac_id' =>auth()->id(),
                        'cijena'=>$Cart->totalprc,
                        'stanjes_id'=>$stanje->id
                    ]);
                    foreach($Cart->items as $korpa)
                    { 
                            
                            Stavke::create([
                                'tekst'=>$korpa['item']->tekst,
                                'visina'=>$korpa['item']->visina,
                                'sirina'=>$korpa['item']->sirina,
                                'opis'=>"",
                                'cijena'=>$korpa['price'],
                                'kolicina'=>$korpa['qty'],
                                'obliks_id'=> $korpa['item']->obliks_id?$korpa['item']->obliks_id:null,
                                'fonts_id'=>$korpa['item']->font_id?$korpa['item']->font_id:null,
                                'kategorijas_id'=>$korpa['item']->kategorijas_id,
                                'proizvods_id'=>$korpa['item']->id,
                                'narudzbas_id'=>$narudzba->id,
                                'images_id'=>$korpa['item']->images_id?$korpa['item']->images_id:null,
                                'materijals_id'=>$korpa['item']->materijals_id,
                               ]);
                       
                    }
                
            
                    Session::forget('cart');
                }
                else{
                    $request->validate([
                        'tekst'=>'required',
                        'visina'=>'required',
                        'sirina'=>'required',
                        'kategorija_id'=>'required',
       
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
                    $images_id=$imagedb? $imagedb->id:null;

                    $narudzba=Narudzba::create([
                        'narucilac_id' =>auth()->id(),
                        'cijena'=>0,
                        'stanjes_id'=>$stanje->id
                    ]);
 
                 $stavke=Stavke::create([
                     'tekst'=>$request->get('tekst'),
                     'visina'=>$request->get('visina'),
                     'sirina'=>$request->get('sirina'),
                     'opis'=>$request->get('opis'),
                     'cijena'=>0,
                     'kolicina'=>1,
                     'proizvods_id'=>null,
                     'obliks_id'=>$oblik_id,
                     'fonts_id'=>$font_id,
                     'materijals_id'=>$materijal_id,
                     'narudzbas_id'=>$narudzba->id,
                     'images_id'=>$images_id,
                     'kategorijas_id'=>$request->get('kategorija_id'),
                 ]);

                 
                }
    
                        
                $request->session()->flash('alert-success', 'Hvala na suradnji. O izradi proizvoda biti cete blagovremeno obavjesteni.');
                return view('home.home');
            }
            else{

                $request->validate([
                    'tekst'=>'required',
                    'visina'=>'required',
                    'sirina'=>'required',
                    'kategorija_id'=>'required',
   
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
                 $images_id=$imagedb? $imagedb->id:null;
               
                $oldNarudzbaPodaci=Session::has('narudzbaPodaci')? Session::get('narudzbaPodaci'):null;
                
                $narudzbaPodaci= new NarudzbaPodaci($oldNarudzbaPodaci);
                
                $narudzbaPodaci->add($request->get('tekst'),$request->get('visina'),
                $request->get('sirina'),$request->get('opis'),$oblik_id,
                $font_id,$materijal_id, $images_id, $request->get('kategorija_id'));
                
                $request->session()->put('narudzbaPodaci',$narudzbaPodaci);

                return redirect()->action([VerifikacijaController::class, 'contactForm']);
            }
     }
    public function update(Request $request, $id){
 
        // Validate the inputs provjeravati cu da li su null ako nisu update
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $narudzba=Narudzba::with('user')->find($id);
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
                $stavke =Stavke::latest()->where('narudzbas_id','=',$id)->with(['kategorija','font','oblik','materijal','image'])->get();
                if($request->has('email')){
                    if($narudzba->email!=null){
                         Mail::to($narudzba->email)->send(new NarudzbaIzmjena($narudzba, $stavke));

                    }
                    else if($narudzba->narucilac_id!=null){
                        Mail::to($narudzba->user->email)->send(new NarudzbaIzmjena($narudzba, $stavke));

                    }
                   
                }
                if($request->has('sms')){
                if($narudzba->telefon!=null){
                        try {

                            $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
                            $client = new \Nexmo\Client($basic);
            
                            $receiverNumber =$narudzba->telefon;
            
                            $message = "Vaša narudžba je ".$narudzba->stanje->naziv.". Cijena narudžbe je ".$narudzba->cijena." KM. Naruceno ".$narudzba->created_at->diffForHumans().". Lijep pozdrav od Mikro-graf radnje/";

                          
                            dd($message);
                            $message = $client->message()->send([
                                'to' => $receiverNumber,
                                'from' => 'mikro-graf',
                                'text' => $message
            
                            ]);
            
                        }
                        catch (Exception $e) {
                            $request->session()->flash('alert-warning',$e->getMessage());
                            }
                        
                }
                if($narudzba->narucilac_id!=null){
                    try {

                        $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
                        $client = new \Nexmo\Client($basic);
        
                        $receiverNumber =$narudzba->user->telefon;
        
                        $message = "Vaša narudžba je ".$narudzba->stanje->naziv.". Cijena narudžbe je ".$narudzba->cijena." KM. Naruceno ".$narudzba->created_at->diffForHumans().". Lijep pozdrav od Mikro-graf radnje/";
                      
                        dd($message);
                        $message = $client->message()->send([
                            'to' => $receiverNumber,
                            'from' => 'mikro-graf',
                            'text' => $message
        
                        ]);
        
                    }
                    catch (Exception $e) {
                        $request->session()->flash('alert-warning',$e->getMessage());
                        
                    }
                  }
                  
                }
                  
                
            }
        }
     
        return redirect()->route('narudzba.narudzbe');
    }

 
    public function show(Narudzba $narudzba){
        $stanja=Stanje::get();
        return view('narudzba.narudzbaUpdate',['narudzba'=>$narudzba,'stanja'=>$stanja]);
    }
}
