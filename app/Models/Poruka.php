<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poruka extends Model
{
    use HasFactory;
    protected $fillable = [
        'sadrzaj',
        'email',
        'posiljaoc_id',
        'razgovor_id',
    ];
    public function user(){
        return $this->belongsTo(Uesr::class,'posiljaoc_id','id');
    }
    public function razgovor(){
        return $this->belongsTo(Razgovor::class,'razgovor_id','id');
    }
}
