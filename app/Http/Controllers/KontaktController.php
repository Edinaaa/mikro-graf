<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontaktController extends Controller
{
    public function create()
    {
       
      
                $primaoci = DB::table('users')
                    ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
                    ->join('roles', 'users_roles.role_id', '=', 'roles.id')
                    ->where('roles.name','=','admin')
                    ->select('users.id','users.name','users.lastname','users.email','users.telefon')
                    ->get();
        
        return view("kontakt.kontakt",['primaoci'=>$primaoci]);
    
    }
}
