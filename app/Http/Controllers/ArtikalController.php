<?php

namespace App\Http\Controllers;
use App\Models\Artikal;
use App\Models\Materijal;
use App\Models\Artikal_materijals;
use Illuminate\Support\Facades\DB;


use App\Http\Requests;
use Session;
use App\Models\SelektovaniMaterijali;
use Illuminate\Http\Request;

class ArtikalController extends Controller
{
    public function create()
    {
        $artikli =Artikal::latest()->paginate(10);
        $materijali =Materijal::get();

        return view('artikal.artikal',['artikli'=>$artikli,'materijali'=>$materijali]);
    }
    public function show(Artikal $artikal){

        $materijali =Materijal::get();
        $artikal_materijals=DB::table('artikal_materijals')
        ->where('artikals_id','=',$artikal->id)
        ->select('materijals_id')
        ->get();
        $selecMaterijali=$artikal_materijals->implode('materijals_id', ',');
        return view('artikal.update',['artikal'=>$artikal,'materijali'=>$materijali,'selecMaterijali'=>$selecMaterijali]);
    }
    public function update(Request $request, $id)
    {
        $artikal=Artikal::find($id);
     
        $request->validate([
            "naziv"=>'required',

        ]);
           $aktivan=false;
           if($request->has('aktivan')){
               $aktivan=true;
           }
           $artikal->naziv=$request->get('naziv');
           $artikal->aktivan=$aktivan;
           $artikal->save();
           $ms= preg_split("/[,]/",$request->get('selecMaterijali'));

        $artikal_materijal=Artikal_materijals::where('artikals_id','=',$id)->get();

           foreach($ms as $id)
           {
             $nijepronadjen=true;

               foreach ($artikal_materijal as $am){

                    if($id==$am->materijals_id)
                    {
                        $nijepronadjen=false;
                       
                    }
               }
               
               if($nijepronadjen && $id!=""){
                Artikal_materijals::create([
                    'artikals_id'=>$artikal->id,
                    'materijals_id'=>$id]);}
           }
           foreach($artikal_materijal as $am)
           {
           $pronadjen=false;

               foreach ($ms as $id){

                if($id==$am->materijals_id)
                    {
                        $pronadjen=true;
                        break;
                    }
               }
               if(!$pronadjen){

                $artiaklamaterijal=$am;
                    $artiaklamaterijal->delete();

               }
            
           }
        
           $request->session()->flash('alert-success', 'Uspjesno izmjenjen artikal.');
    
           return redirect()->route('artikal');
    }
    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required',

        ]);

       
        $aktivan=false;
        if($request->has('aktivan')){
            $aktivan=true;
        }
        
           $artikal= Artikal::create([
                    "naziv" =>$request->get('naziv'),
                    "aktivan"=>$aktivan,
                    "kreirao_id" =>auth()->id()]);

                     $ms= preg_split("/[,]/",$request->get('selecMaterijali'));
                foreach($ms as $id)
                {
                    if($id!=""){
                        Artikal_materijals::create([
                            'artikals_id'=>$artikal->id,
                            'materijals_id'=>$id]);
                    }
                    

                }

            $request->session()->flash('alert-success', 'Uspjesno dodan artikal.');
    
        return back();
    }
 
}
