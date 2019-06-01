<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CommentController extends ApiController
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
            'user_id' => 'required|numeric',
            'post_id' => 'required|numeric',
            'content' => 'required|string'
        ]);

        $commentData = $request->all();

        $comment = Comment::create($commentData);

        return $this->successResponse($comment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::where('post_id', $id)
                            ->with('user')
                            ->get();

        return $this->successResponse($comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);

        $comment->delete();

        return $this->showMessage('OK', 204);
    }
}
