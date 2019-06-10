<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function before(User $auth, $ability)
    {
        if ($auth->isAdmin()) {
            return true;
        }
    }

    public function index(User $auth)
    {
        return $auth->isAdmin();
    }

    public function update(User $auth, User $user)
    {
        return $auth->id === $user->id;
    }
}
