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
        'narucilacs_id',

       
    ];
}
