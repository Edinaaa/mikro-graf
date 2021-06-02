<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Proizvod;
use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NarudzbaController extends Controller
{
    public function create(){
       $oblici =Oblik::latest()->with('image')->paginate(6);
       $fontovi =Font::latest()->with('image')->paginate(6);
       $materijali =Materijal::latest()->with('image')->paginate(6);

        //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
     // $posts= Posts::get()  ;  vraca sve posts iz baze ::where(),Find()
        //orderBy('created_at','desc') je isto sto latest()
        return view('narudzba.narudzba',['oblici'=>$oblici,'fontovi'=>$fontovi,'materijali'=>$materijali]);
    }
    public function Pregled(){
//'image',
        if(Auth::check())
        {
           
            if(auth()->user()->hasRole('admin')){
                $narudzbe =Narudzba::latest()->with(['proizvod','font','oblik','materijal'])->paginate(6);

            }
            else{
            $narudzbe =Narudzba::latest()->where('narucilac_id','=',auth()->id())->with(['proizvod','font','oblik','materijal'])->paginate(6);

            }

            return view('narudzba.narudzbe',['narudzbe'=>$narudzbe]);
        }
        else{
            return view('auth.register');

        }
     }
    public function Proizvod(Proizvod $proizvod,Request $request){

            if ($proizvod->naziv=="Plocica za vrata") {
               
                if(Auth::check()){
                    Narudzba::create([
                        'naziv'=>$proizvod->naziv,
                        'visina'=>$proizvod->visina,
                        'sirina'=>$proizvod->sirina,
                        'opis'=>"",
                        'cijena'=>$proizvod->cijena,
                        'obliks_id'=>$proizvod->obliks_id,
                        'fonts_id'=>$proizvod->fonts_id,
                        'materijals_id'=>$proizvod->materijals_id,
                        'narucilac_id' =>auth()->id()]);
                }
                else{
                    $request->validate([
                        'email'=>'required',
                        'telefon'=>'required',
                    ]);
                    Narudzba::create([
                        'proizvods_id'=>$proizvod->id,
                        'naziv'=>$proizvod->naziv,
                        'visina'=>$proizvod->visina,
                        'sirina'=>$proizvod->sirina,
                        'opis'=>"",
                        'cijena'=>$proizvod->cijena,
                        'obliks_id'=>$proizvod->obliks_id,
                        'fonts_id'=>$proizvod->fonts_id,
                        'materijals_id'=>$proizvod->materijals_id,
                        'email'=>$request->get('email'),
                        'telefon'=>$request->get('telefon'),
                       ]);
                }
                
            }
        
            else{
                if(Auth::check()){
                    Narudzba::create([
                        'proizvods_id'=>$proizvod->id,
                        'naziv'=>$proizvod->naziv,
                        'visina'=>$proizvod->visina,
                        'sirina'=>$proizvod->sirina,
                        'opis'=>"",
                        'cijena'=>$proizvod->cijena,
                        'fonts_id'=>$proizvod->fonts_id,
                        'materijals_id'=>$proizvod->materijals_id,
                        'narucilac_id' =>auth()->id()]);
                }
                else{
                    $request->validate([
                        'email'=>'required',
                        'telefon'=>'required',
                    ]);
                    Narudzba::create([
                        'proizvods_id'=>$proizvod->id,
                        'naziv'=>$proizvod->naziv,
                        'visina'=>$proizvod->visina,
                        'sirina'=>$proizvod->sirina,
                        'opis'=>"",
                        'cijena'=>$proizvod->cijena,
                        'fonts_id'=>$proizvod->fonts_id,
                        'materijals_id'=>$proizvod->materijals_id,
                        'email'=>$request->get('email'),
                        'telefon'=>$request->get('telefon'),
                       ]);
                }
            } 
         
        return back();
    }   

    public function store(Request $request){

            // Validate the inputs
            $request->validate([
                'naziv'=>'required',
                'visina'=>'required',
                'sirina'=>'required',
                'font_id'=>'required',
                'materijal_id'=>'required',
            ]);
          
            if ($request->naziv=="Plocica za vrata") {
                    $request->validate([
                        'oblik_id'=>'required',
                    ]);
    
                    if(Auth::check()){
                        Narudzba::create([
                            'naziv'=>$request->get('naziv'),
                            'visina'=>$request->get('visina'),
                            'sirina'=>$request->get('sirina'),
                            'opis'=>$request->get('opis'),
                            'cijena'=>'0',
                            'obliks_id'=>$request->get('oblik_id'),
                            'fonts_id'=>$request->get('font_id'),
                            'materijals_id'=>$request->get('materijal_id'),
                            'narucilac_id' =>auth()->id()]);
                    }
                    else{
                        $request->validate([
                            'email'=>'required',
                            'telefon'=>'required',
                        ]);
                        Narudzba::create([
                            'naziv'=>$request->get('naziv'),
                            'visina'=>$request->get('visina'),
                            'sirina'=>$request->get('sirina'),
                            'cijena'=>'0',
                            'opis'=>$request->get('opis'),
                            'obliks_id'=>$request->get('oblik_id'),
                            'fonts_id'=>$request->get('font_id'),
                            'materijals_id'=>$request->get('materijal_id'),
                            'email'=>$request->get('email'),
                            'telefon'=>$request->get('telefon'),
                           ]);
                    }
                    
            }
            
            else{
                    if(Auth::check()){
                        Narudzba::create([
                            'naziv'=>$request->get('naziv'),
                            'visina'=>$request->get('visina'),
                            'sirina'=>$request->get('sirina'),
                            'opis'=>$request->get('opis'),
                            'cijena'=>'0',
                            'fonts_id'=>$request->get('font_id'),
                            'materijals_id'=>$request->get('materijal_id'),
                            'narucilac_id' =>auth()->id()]);
                    }
                    else{
                        $request->validate([
                            'email'=>'required',
                            'telefon'=>'required',
                        ]);
                        Narudzba::create([
                            'naziv'=>$request->get('naziv'),
                            'visina'=>$request->get('visina'),
                            'sirina'=>$request->get('sirina'),
                            'opis'=>$request->get('opis'),
                            'cijena'=>'0',
                            'fonts_id'=>$request->get('font_id'),
                            'materijals_id'=>$request->get('materijal_id'),
                            'email'=>$request->get('email'),
                            'telefon'=>$request->get('telefon'),
                           ]);
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
