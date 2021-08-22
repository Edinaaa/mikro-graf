<?php

namespace App\Http\Controllers;
use App\Models\Kategorija;
use App\Models\Materijal;
use App\Models\Kategorija_materijals;
use App\Models\SelektovaniMaterijali;


use App\Http\Requests;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class KategorijaController extends Controller
{
    public function create()
    {
        $kategorije =Kategorija::latest()->paginate(10);
        $materijali =Materijal::get();

        return view('kategorija.kategorija',['kategorije'=>$kategorije,'materijali'=>$materijali]);
    }
    public function show(Kategorija $kategorija){

        $materijali =Materijal::get();
        $kategorija_materijals=DB::table('kategorija_materijals')
        ->where('kategorijas_id','=',$kategorija->id)
        ->select('materijals_id')
        ->get();
        $selecMaterijali=$kategorija_materijals->implode('materijals_id', ',');
        return view('kategorija.update',['kategorija'=>$kategorija,'materijali'=>$materijali,'selecMaterijali'=>$selecMaterijali]);
    }
    public function update(Request $request, $id)
    {
     
        $request->validate([
            "naziv"=>'required|max:100',

        ]);
        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $kategorija=Kategorija::find($id);

                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                $kategorija->naziv=$request->get('naziv');
                $kategorija->aktivan=$aktivan;
                $kategorija->save();
                $ms= preg_split("/[,]/",$request->get('selecMaterijali'));

                $kategorija_materijal=Kategorija_materijals::where('kategorijas_id','=',$id)->get();

                foreach($ms as $id)
                {
                    $nijepronadjen=true;

                    foreach ($kategorija_materijal as $am){

                            if($id==$am->materijals_id)
                            {
                                $nijepronadjen=false;
                            
                            }
                    }
                    
                    if($nijepronadjen && $id!=""){
                        Kategorija_materijals::create([
                            'kategorijas_id'=>$kategorija->id,
                            'materijals_id'=>$id]);}
                }
                foreach($kategorija_materijal as $am)
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
            
                $request->session()->flash('alert-success', 'Uspješno izmjenjena kategorija.');
            
                return redirect()->route('kategorija');
            }
        }  
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');

        return redirect()->route('kategorija');

    }
    public function store(Request $request)
    {
        $request->validate([
            "naziv"=>'required|max:100',

        ]);

        if(Auth::check()){
            if(auth()->user()->hasRole('admin')){
                $aktivan=false;
                if($request->has('aktivan')){
                    $aktivan=true;
                }
                
                $kategorija= Kategorija::create([
                    "naziv" =>$request->get('naziv'),
                    "aktivan"=>$aktivan,
                    "kreirao_id" =>auth()->id()
                ]);

                $ms= preg_split("/[,]/",$request->get('selecMaterijali'));
                foreach($ms as $id)
                {
                    if($id!=""){
                        Kategorija_materijals::create([
                            'kategorijas_id'=>$kategorija->id,
                            'materijals_id'=>$id]);
                    }
                
                }

                $request->session()->flash('alert-success', 'Uspješno dodana kategorija.');
            
                return back();
            }
        }  
        $request->session()->flash('alert-warning', 'Za to akciju nemate privilegije.');

        return back();

    }
 
}
