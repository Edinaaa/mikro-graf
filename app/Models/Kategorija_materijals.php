<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorija_materijals extends Model
{
    use HasFactory;
   
        protected $fillable = [
            'kategorijas_id',
            'materijals_id',
        ];
        public function kategorija(){
            return $this->belongsTo(Kategorija::class,'kategorijas_id','id');
        }
        public function materijal(){
            return $this->belongsTo(Materijal::class,'materijals_id','id');
        }
        public function image(){
            return $this->hasOneThrough(Materijal::class, Images::class);
        }

}
