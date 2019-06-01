<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function destroy(User $auth, Comment $comment)
    {
        $post = $comment->post;

        return $auth->id === $comment->user_id
            || $auth->id === $post->user_id;
    }
}
