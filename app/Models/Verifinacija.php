<?php

namespace App\Models;


class Verifikacija
{
   public $email;
   public $telefon=0;
   public $telefonv=0;

   public function __construct($oldVerifikacija){
       if($oldVerifikacija){
           $this->email=$oldVerifikacija->email;
           $this->telefon=$oldVerifikacija->telefon;
           $this->telefonv=$oldVerifikacija->telefonv;


       }
   }

   public function add($e,$t,$tv){
        
    $this->email=$e;
    $this->telefon=$t;
    $this->telefonv=$tv;
   }
    

}
