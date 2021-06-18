<?php

namespace App\Policies;
use App\Models\Stanje;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StanjePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Stanje $artikal){

        return $user->id=== $artikal->kreirao_id;
    }
    public function update(User $user, Stanje $artikal){

        return $user->id=== $artikal->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
