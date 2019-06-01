<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'content'
    ];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'comments';


    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;


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
