<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Relationship with profiles table
     * @return Profile
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }


    /**
     * Relationship with posts table
     * @return Post
     */
    public function post()
    {
        return $this->hasMany('App\Post');
    }


    /**
     * Relationship with likes table
     * @return Like
     */
    public function like()
    {
        return $this->hasMany('App\Like');
    }


    /**
     * Relationship with comments table
     * @return Comment
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }


    /**
     * Relationship with follows table
     * @return User
     */
    public function following()
    {
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'following');
    }


    /**
     * Relationship with message table (Received messages)
     * @return User
     */
    public function follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'following', 'user_id');
    }
}
