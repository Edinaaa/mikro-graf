<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikal_materijals extends Model
{
    use HasFactory;
   
        protected $fillable = [
            'artikals_id',
            'materijals_id',
        ];
        public function artikal(){
            return $this->belongsTo(Artikal::class,'artikals_id','id');
        }
        public function materijal(){
            return $this->belongsTo(Materijal::class,'materijals_id','id');
        }
        public function image(){
            return $this->hasOneThrough(Materijal::class, Images::class);
        }

}
