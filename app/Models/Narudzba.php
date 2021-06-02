<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narudzba extends Model
{
    use HasFactory;
    protected $fillable = [
        "naziv",
        "visina",
        "sirina",
        "opis",
        "cijena",
        "email",
        "telefon",
        'proizvods_id',
        'obliks_id',
        'fonts_id',
        'materijals_id',
        'narucilac_id',

       
    ];
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
    public function user(){
       return $this->belongsTo(Uesr::class,'kreirao_id','id');
   }
}
