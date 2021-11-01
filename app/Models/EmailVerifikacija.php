<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerifikacija extends Model
{
    use HasFactory;
    protected $fillable = [
      
        "email",
        "token",
        "aktivan",
        
       
    ];
}
