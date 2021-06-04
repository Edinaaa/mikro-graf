<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_roles extends Model
{
    use HasFactory;
    protected $fillable = [
        
    ];
    public function user(){
        return $this->belongsTo(Uesr::class,'user_id','id');
    }
    public function role(){
        return $this->belongsTo(Razgovor::class,'role_id','id');
    }
}
