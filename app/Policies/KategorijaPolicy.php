<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategorija;

use Illuminate\Auth\Access\HandlesAuthorization;

class KategorijaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Kategorija $kategorija){

        return $user->id=== $kategorija->kreirao_id;
    }
    public function update(User $user, Kategorija $kategorija){

        return $user->id=== $kategorija->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
