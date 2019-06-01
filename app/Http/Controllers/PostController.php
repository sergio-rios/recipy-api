<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PostController extends ApiController
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:10000'
        ]);

        $user = auth()->user();
        $postData = $request->all();
        $postData['user_id'] = $user->id;        

        $post = Post::create($postData);

        return $this->showOne($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post['user'] = $post->user;
        $post['like'] = $post->like;
        $post['comment'] = $post->comment;

        return $this->showOne($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
