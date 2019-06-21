<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function update(User $auth, Post $post)
    {
        return $auth->id === $post->user_id;
    }

    public function destroy(User $auth, Post $post)
    {
        return $auth->id === $post->user_id;
    }
}
