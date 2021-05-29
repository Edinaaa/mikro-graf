<?php

namespace App\Policies;
use App\Models\Proizvod;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProizvodPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Proizvod $proizvod){

        return $user->id=== $proizvod->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
