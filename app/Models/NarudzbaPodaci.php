<?php

namespace App\Models;


class NarudzbaPodaci
{
   public $email;
   public $telefon=0;
   public $telefonv=0;
   public $tekst;
   public $visina;
   public $sirina;
   public $opis;
   public $obliks_id=null;
   public $fonts_id=null;
   public $materijals_id;
   public $images_id;
   public $kategorijas_id;

   public function __construct($oldNarudzbaPodaci){
       if($oldNarudzbaPodaci){
           $this->email=$oldNarudzbaPodaci->email;
           $this->telefon=$oldNarudzbaPodaci->telefon;
           $this->telefonv=$oldNarudzbaPodaci->telefonv;
           $this->tekst=$oldNarudzbaPodaci->tekst;
           $this->visina=$oldNarudzbaPodaci->visina;
           $this->sirina=$oldNarudzbaPodaci->sirina;
           $this->opis=$oldNarudzbaPodaci->opis;
           $this->obliks_id=$oldNarudzbaPodaci->obliks_id;
           $this->fonts_id=$oldNarudzbaPodaci->fonts_id;
           $this->materijals_id=$oldNarudzbaPodaci->materijals_id;
           $this->images_id=$oldNarudzbaPodaci->images_id;
           $this->kategorijas_id=$oldNarudzbaPodaci->kategorijas_id;


       }
   }
   public function add($tekst,$visina,$sirina,
    $opis,$obliks_id,$fonts_id,
      $materijals_id,$file,$kategorijas_id){
        
    $this->tekst=$tekst;
    $this->visina=$visina;
    $this->sirina=$sirina;
    $this->opis=$opis;
    $this->obliks_id=$obliks_id;
    $this->fonts_id=$fonts_id;
    $this->materijals_id=$materijals_id;
    $this->file=$file;
    $this->kategorijas_id=$kategorijas_id;
   }
   public function edit($e,$t,$tv){
        
    $this->email=$e;
    $this->telefon=$t;
    $this->telefonv=$tv;
   }
   public function TelefonKood($tk){
        
   return  $this->telefonv==$tk;
   }

}
