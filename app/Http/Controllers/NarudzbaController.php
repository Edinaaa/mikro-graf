<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class NarudzbaController extends Controller
{
    public function index(){
      //  $objave =Objava::latest()->with(['user','likes'])->paginate(2);
        //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
     // $posts= Posts::get()  ;  vraca sve posts iz baze ::where(),Find()
        //orderBy('created_at','desc') je isto sto latest()
      //  return view('posts.objava',[ 'posts'=>$objave]);
    }
    public function store(Request $request){

     /*    $this->validate($request, 
        [
            'body'=>'required'
        ]);
        Objava::create([
            'user_id'=>auth()->id(),//auth()->user()->id()
            'body'=>$request->body
        ]);*/
       /*                                     //[ 'body'=>$request->body] ili  $request->only('body')
        $request->user()->posts()->create([//dodaje novi post u bazu, posts() je metoda u User.php hasMany
                                            // prepozna trenutno logiranog i doda njegov id
            'body'=>$request->body

        ]);*/ 
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
