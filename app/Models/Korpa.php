<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    use HasFactory;
    protected $fillable = [
        "tekst",
        "visina",
        "sirina",
        "opis",
        "cijena",
        "kolicina",
        'proizvods_id',
        'obliks_id',
        'fonts_id',
        'materijals_id',
        'narudzbas_id',
        'images_id',
        'artikals_id',
       
    ];
    public function image(){
        return $this->belongsTo(Images::class,'images_id','id');
    }
    public function artikal(){
        return $this->belongsTo(Artikal::class,'artikals_id','id');
    }
    public function proizvod(){
        return $this->belongsTo(Proizvod::class,'proizvods_id','id');
    }
    public function font(){
        return $this->belongsTo(Font::class,'fonts_id','id');
    }
    public function oblik(){
        return $this->belongsTo(Oblik::class,'obliks_id','id');
    }
    public function materijal(){
        return $this->belongsTo(Materijal::class,'materijals_id','id');
    }
    public function narudzba(){
        return $this->belongsTo(Narudzba::class,'narudzbas_id','id');
    }
}
