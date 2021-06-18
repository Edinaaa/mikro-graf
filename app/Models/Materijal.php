<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materijal extends Model
{
    use HasFactory;
    protected $fillable = [
        'naziv',
        'images_id',
        'kreirao_id',
        'visina',
        'sirina',
        'aktivan',


    ];
    public function image(){
        return $this->belongsTo(Images::class,'images_id','id');
    }
    public function user(){
       return $this->belongsTo(Uesr::class,'kreirao_id','id');
   }
}
