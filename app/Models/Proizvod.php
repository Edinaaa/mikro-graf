<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    use HasFactory;

    protected $fillable = [
        'tekst',
        'visina',
        'sirina',
        'cijena',
        'popust',
        'novo',
        'aktivan',
        'obliks_id',
        'fonts_id',
        'materijals_id',
        'images_id',
        'kreirao_id',
        'kategorijas_id',


    ];
    public function kategorija(){
        return $this->belongsTo(Kategorija::class,'kategorijas_id','id');
    }
    public function image(){
        return $this->belongsTo(Images::class,'images_id','id');
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
