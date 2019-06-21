<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('user', 'UserController', [
    'except' => ['edit', 'create']
]);

Route::prefix('user/{user}')->group(function () {
    Route::get('post', 'UserController@post')->name('user.post');
    Route::get('post/{init?}/{num?}', 'UserController@pagePost');    
    Route::get('follower', 'UserController@follower')->name('user.follower');
    Route::get('following', 'UserController@following')->name('user.following');
});

Route::resource('post', 'PostController', [
    'except' => ['index', 'edit', 'create']
]);

Route::resource('comment', 'CommentController', [
    'only' => ['store', 'show', 'destroy']
]);

Route::resource('like', 'LikeController', [
    'only' => ['store', 'destroy']
]);

Route::resource('tag', 'TagController', [
    'only' => ['store', 'index']
]);

Route::prefix('follow')->group(function () {
    Route::get('following/{id}', 'FollowController@following')->name('follow.following');
    Route::post('follow/{id}', 'FollowController@follow')->name('follow.follow');
    Route::delete('unfollow/{id}', 'FollowController@unfollow')->name('follow.unfollow');
});

Route::get('search', 'SearchController@search')->name('search');

Route::get('news', 'NewsController@news')->name('news');

Route::get('featured/week', 'FeaturedController@week')->name('featured.week');
Route::get('featured/month', 'FeaturedController@month')->name('featured.month');

Route::get('user/verify-email/{token}', 'UserController@verify')->name('verify');
Route::get('user/{user}/resend-verification', 'UserController@resend')->name('resend');

Route::post('login', 'AuthController@login')->name('login')
                                            ->middleware('api');

Route::get('/token/refresh', 'AuthController@refresh')->name('login.refresh');

