<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Artikal;

use Illuminate\Auth\Access\HandlesAuthorization;

class ArtikalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Artikal $artikal){

        return $user->id=== $artikal->kreirao_id;
    }
    public function update(User $user, Artikal $artikal){

        return $user->id=== $artikal->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
