<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razgovor extends Model
{
    use HasFactory;
    protected $fillable = [
        'tema',
        'email',
        'posiljaoc_id',
        'primaoc_id',
    ];
    public function posiljaoc(){
        return $this->belongsTo(User::class,'posiljaoc_id','id');
    }
    public function primaoc(){
        return $this->belongsTo(User::class,'primaoc_id','id');
    }
    public function porukezadnje(){
        return $this->hasMany(Poruka::class)->latest();
    }
    public function poruke(){
        return $this->hasMany(Poruka::class);
    }
   
}
