<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'naziv',
        'visina',
        'sirina',
        'cijena',
        'popust',
        'novo',
        'obliks_id',
        'fonts_id',
        'materijals_id',
        'images_id',
        'kreirao_id',



    ];
    public function image(){
        return $this->belongsTo(Images::class,'images_id','id');
    }
    public function user(){
       return $this->belongsTo(Uesr::class,'kreirao_id','id');
   }
}
