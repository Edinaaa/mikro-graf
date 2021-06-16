<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailServiceController extends Controller
{
    //
    public function create()
    {
       
        $data = array('oblik'=>"Virat Gandhi",'materijal'=>"Virat Gandhi");

        Mail::raw('Podaci o narudzbi', function($message) {
            $message->to('info@mikro-graf.com', 'Edin Turnic')->subject
               ('Nova narudzba!');
            $message->from('no-reply@mikro-graf.com');
         });
    
         Mail::raw('Hvala na povjerenju!', function($message) {
            $message->to('korisnik@neki.gmail.com')->subject
               ('Narudzba potrvrdjena!');
            $message->from('no-reply@mikro-graf.com');
         });
    
         echo "Basic Email Sent. Check your inbox.";
       
    }
 
}
