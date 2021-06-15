<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Korpa;

use App\Models\Images;
use App\Models\Artikal;
use App\Models\Oblik;
use App\Models\Font;
use App\Models\Materijal;
use App\Models\Cart;
use App\Models\Stanje;
use App\Models\Proizvod;


use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KorpaController extends Controller
{
    public function create($id){
        if(Auth::check())
         {
            $narudzba=Narudzba::with(['stanje'])->find($id);
            $stanja=null;

            $korpa=null;
             if(auth()->user()->hasRole('admin')){
               
                 $korpa =Korpa::latest()->where('narudzbas_id','=',$id)->with(['artikal','font','oblik','materijal','image'])->paginate(6);
                 $stanja=Stanje::get();
             }
             else{
                
                 if($narudzba->narucilac_id==auth()->id()){
                    $korpa =Korpa::latest()->where('narudzbas_id','=',$id)->with(['artikal','font','oblik','materijal','image'])->paginate(6);
                 }
                 else{
                    return view('auth.register');

                 }
 
             }
 
             return view('korpa.stavke',['korpa'=>$korpa,'narudzba'=>$narudzba, 'stanja'=>$stanja]);
         }
         
        return view('auth.register');
 
         
    }
    public function GetCart(){
        if(!Session::has('cart'))
        {}
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        return view('korpa.cart',['proizvodi'=>$cart->items,'ukupnoCijena'=>$cart->totalprc,'ukupnoKolicina'=>$cart->totalqty]);
    }
    public function SelektAdd(Request $request,$id){
        
        $proizvod=Proizvod::find($id);
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->add($proizvod, $proizvod->id);
        $request->session()->put('cart',$cart);
        return redirect()->route('proizvodi');
    }
     public function store(Request $request){
        $Cart=Session::has('cart')? Session::get('cart'):null;
        if($Cart){
            $stanje=Stanje::where('naziv','=','Naruceno')->first();

            $narudzba=null;
            if(Auth::check()){
                $narudzba=Narudzba::create([
                    'cijena'=>$Cart->totalprc,
                    'narucilac_id' =>auth()->id(),
                    'stanjes_id'=>$stanje->id]);
            }
            else{
                $request->validate([
                    'email'=>'required',
                    'telefon'=>'required',
                ]);
                $narudzba=Narudzba::create([
                    'cijena'=>$Cart->totalprc,
                    'email'=>$request->get('email'),
                    'telefon'=>$request->get('telefon'),
                    'stanjes_id'=>$stanje->id ]);
            }
          $artikal=Artikal::where('naziv','=','Plocica za vrata')->first();
            foreach($Cart->items as $korpa)
            { 
                    $plocica=$korpa['item']->artikals_id==$artikal->id;
                    
                    Korpa::create([
                        'tekst'=>$korpa['item']->tekst,
                        'visina'=>$korpa['item']->visina,
                        'sirina'=>$korpa['item']->sirina,
                        'opis'=>"",
                        'cijena'=>$korpa['price'],
                        'kolicina'=>$korpa['qty'],
                        'obliks_id'=> $plocica?$korpa['item']->obliks_id:null,
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
    
       
       
           
         return redirect()->route('proizvodi');
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
