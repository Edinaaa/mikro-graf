<?php

namespace App\Models;


class UserPodaci
{
   public $email;
   public $telefon=0;
   public $telefonv=0;
   public $name;
   public $lastname;
   public $pass;

  

   public function __construct($oldUserPodaci){
       if($oldUserPodaci){
           $this->email=$oldUserPodaci->email;
           $this->telefon=$oldUserPodaci->telefon;
           $this->telefonv=$oldUserPodaci->telefonv;
           $this->name=$oldUserPodaci->name;
           $this->lastname=$oldUserPodaci->lastname;
           $this->pass=$oldUserPodaci->pass;
           
       }
   }
   public function add($name,$lastname,$email,
    $telefon,$pass){
        
    $this->name=$name;
    $this->lastname=$lastname;
    $this->email=$email;
    $this->telefon=$telefon;
    $this->pass=$pass;
  
   }
  
   public function TelefonKood($tk){
        
   return  $this->telefonv==$tk;
   }

}
