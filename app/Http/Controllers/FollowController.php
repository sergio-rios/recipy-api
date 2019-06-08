<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class FollowController extends ApiController
{
    /**
     * Create a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function following($id)
    {
        $user = User::find($id);
        $following = auth()->user()->following;
        $response = $following->contains($user);

        return $this->successResponse($response);
    }

    public function follow(User $user)
    {
        DB::insert('INSERT INTO follows (user_id, following) VALUES (:authId, :user);', [
            'authId' => auth()->user()->id,
            'user' => $id
        ]);

        return $this->showMessage('OK', 201);
    }

    public function unfollow(User $user)
    {
        DB::delete('DELETE FROM follows WHERE user_id = :authId AND following = :user;' , [
            'authId' => auth()->user()->id,
            'user' => $id
        ]);

        return $this->showMessage('OK', 204);
    }
}
