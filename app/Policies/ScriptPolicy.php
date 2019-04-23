<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScriptPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        return $user->canDo(['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
    }

    public function view(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
    }

    public function update(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
    }

    public function delete(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
    }
}
