<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class FeaturedController extends ApiController
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

    public function week()
    {
        $top_week = DB::select('SELECT post_id FROM likes WHERE created_at <= CURRENT_TIMESTAMP AND created_at >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY) GROUP BY post_id ORDER BY COUNT(user_id) DESC LIMIT 0, 3;');

        $week_ids = array_map(function($item) {
            return $item->post_id;
        }, $top_week);
        
        $response = Post::whereIn('id', $week_ids)->get();
        
        return $this->successResponse($response);
    }

    public function month()
    {        
        $top_month = DB::select('SELECT post_id FROM likes WHERE created_at <= CURRENT_TIMESTAMP AND created_at >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 MONTH) GROUP BY post_id ORDER BY COUNT(user_id) DESC LIMIT 0, 3;');

        $month_ids = array_map(function($item) {
            return $item->post_id;
        }, $top_month);
        
        $response = Post::whereIn('id', $month_ids)->get();
        
        return $this->successResponse($response);
    }
}
