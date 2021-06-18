<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narudzba extends Model
{
    use HasFactory;
    protected $fillable = [
      
        "cijena",
        "email",
        "telefon",
        'narucilac_id',
        'stanjes_id',
        'verifikacioni_code',
       
    ];
    public function stanje(){
        return $this->belongsTo(Stanje::class,'stanjes_id','id');
    }
    public function user(){
       return $this->belongsTo(User::class,'narucilac_id','id');
   }
}
