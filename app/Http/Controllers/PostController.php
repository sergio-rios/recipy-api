<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'title' => 'required|string|max:255',
            'tags' => 'required',
            'description' => 'required|string',
            'image' => 'nullable'
        ]);

        $user = auth()->user();
        $postData['user_id'] = $user->id; 
        $postData['title'] = $request->title;
        $postData['description'] = $request->description;
        $tags = $request->tags;

        if ($request->has('image')) {
            $postData['image'] = $request->image;
        }

        $post = Post::create($postData);
        $post->tag()->attach($tags);

        return $this->successResponse($post, 201);
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
        //dd($post);
        //$post['img'] = $this->toDataURL($post['mime'], $post['image']);

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
