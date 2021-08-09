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
    //stavke narudzbe
    public function create($id){
         $narudzba=Narudzba::with(['stanje'])->find($id);
            $stanja=null;

            $korpa=null;
            if(Auth::check())
            {
           
             if(auth()->user()->hasRole('admin')){
               
                 $korpa =Korpa::latest()->where('narudzbas_id','=',$id)->with(['artikal','font','oblik','materijal','image'])->paginate(6);
               
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
    //stavke narudzbe prije nego noruci kupac
    public function GetCart(){
        
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        return view('korpa.cart',['proizvodi'=>$cart->items,'ukupnoCijena'=>$cart->totalprc,'ukupnoKolicina'=>$cart->totalqty]);
    }
    //dodavanje proizvoda u kurpu
    public function SelektAdd(Request $request,$id){
        
        $proizvod=Proizvod::find($id);
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->add($proizvod, $proizvod->id);
        $request->session()->put('cart',$cart);
      //  dd($cart);
        return redirect()->route('proizvodi');
    }

  
 
  
}
