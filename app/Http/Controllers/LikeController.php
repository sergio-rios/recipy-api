<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class LikeController extends ApiController
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
            'post_id' => 'required|numeric'
        ]);

        $likeData['post_id'] = $request->post_id;
        $likeData['user_id'] = auth()->user()->id;

        //dd($likeData);

        $like = Like::create($likeData);

        

        return $this->showMessage('OK', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        $user = auth()->user();
        $like = Like::where([
            ['post_id', '=', $post_id],
            ['user_id', '=', $user->id]
        ]);
        $like->delete();

        return $this->showMessage('OK', 204);
    }
}
