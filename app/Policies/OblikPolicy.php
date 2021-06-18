<?php

namespace App\Policies;
use App\Models\Oblik;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OblikPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Oblik $oblik){

        return $user->id=== $oblik->kreirao_id;
    }
    public function update(User $user, Oblik $oblik){

        return $user->id=== $oblik->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
