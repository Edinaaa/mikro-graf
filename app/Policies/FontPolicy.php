<?php

namespace App\Policies;
use App\Models\Font;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FontPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Font $font){

        return $user->id== $font->kreirao_id;
    }
    public function update(User $user, Font $font){

        return $user->id== $font->kreirao_id;
    }
    public function __construct()
    {
        //
    }
}
