<?php

namespace App\Http\Controllers;
use App\Models\Katerogija;
use App\Models\Narudzba;
use App\Models\Stavke;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class StavkeController extends Controller
{
    //
     //stavke narudzbe
     public function create($id){
        $narudzba=Narudzba::with(['stanje'])->find($id);
           $stanja=null;

           $stavke=null;
           if(Auth::check())
           {
          
            if(auth()->user()->hasRole('admin')){
              
                $stavke =Stavke::latest()->where('narudzbas_id','=',$id)->with(['kategorija','font','oblik','materijal','image'])->paginate(6);
              
            }
            else{
               
                if($narudzba->narucilac_id==auth()->id()){
                   $stavke =Stavke::latest()->where('narudzbas_id','=',$id)->with(['kategorija','font','oblik','materijal','image'])->paginate(6);
                }
                else{
                  $request->session()->flash('alert-info','Registrujte se da bi imali pregled narudžbi.');

                   return view('auth.register');

                }

           }

            return view('stavke.stavke',['stavke'=>$stavke,'narudzba'=>$narudzba, 'stanja'=>$stanja]);
        }
        $request->session()->flash('alert-info','Registrujte se da bi imali pregled narudžbi.');
        
       return view('auth.register');

        
   }
}
