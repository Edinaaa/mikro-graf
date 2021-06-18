<?php

namespace App\Policies;
use App\Models\Materijal;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterijalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Materijal $materijal){

        return $user->id=== $materijal->kreirao_id;
    }
    public function update(User $user, Materijal $materijal){

        return $user->id=== $materijal->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
