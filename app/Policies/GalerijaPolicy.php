<?php

namespace App\Policies;
use App\Models\Galerija;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalerijaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Galerija $galerija){

        return $user->id=== $galerija->kreirao_id;
    }
    public function update(User $user, Galerija $galerija){

        return $user->id=== $galerija->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
