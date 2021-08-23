<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontaktController extends Controller
{
    public function create()
    {
       
      
        $admin = DB::table('users')
            ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->join('roles', 'users_roles.role_id', '=', 'roles.id')
            ->where('roles.name','=','admin')
            ->select('users.email','users.telefon')
            ->first();
        $email=$admin->email;
        $telefon=$admin->telefon;

        return view("kontakt.kontakt",['email'=>$email,'telefon'=>$telefon]);
    
    }
}
