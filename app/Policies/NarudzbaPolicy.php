<?php

namespace App\Policies;
use App\Models\Narudzba;
use App\Models\Role;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NarudzbaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Narudzba $narudzba){
       
        return  auth()->user()->hasRole('admin');
    }
    public function __construct()
    {
        //
    }
}
