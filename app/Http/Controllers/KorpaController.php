<?php

namespace App\Http\Controllers;
use App\Models\Narudzba;
use App\Models\Korpa;

use App\Models\Images;
use App\Models\Katerogija;
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
    
    //stavke narudzbe prije nego noruci kupac
    public function GetCart(){
        
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        return view('korpa.cart',['proizvodi'=>$cart->items,'ukupnoCijena'=>$cart->totalprc,'ukupnoKolicina'=>$cart->totalqty]);
    }
    public function odustani(){
     
        Session::forget('cart');

       return redirect()->route('proizvodi');

        
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
