<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class NewsController extends ApiController
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

    public function news()
    {
        $users = auth()->user()->following;
        $usersId = $users->pluck('id')->all();

        $posts = Post::with('user')
                        ->whereIn('user_id', $usersId)
                        ->orderBy('created_at', 'DESC')
                        ->limit(100)
                        ->get()
                        ->all();

        return $this->successResponse($posts);
    }
}
