<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'likes';


    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'user_id'
    ];


    /**
     * Relationship with users table
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Relationship with posts table
     * @return Post
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
