<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class SearchController extends ApiController
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

    public function search(Request $request)
    {
        $posts = [];
        $tags = $request->all();
        $tagsList = join(",", $tags);

        $postIds = DB::select("SELECT post_id
                    FROM post_tags
                    GROUP BY post_id
                    HAVING
                        SUM(tag_id NOT IN (".$tagsList.")) = 0
                        AND
                        COUNT(DISTINCT tag_id) <= ".count($tags).";");

        $posts = array_map(function($item) {
            $id = $item->post_id;
            return Post::with('user')->find($id);
        }, $postIds);

        return $this->successResponse($posts, 200);
    }
}
