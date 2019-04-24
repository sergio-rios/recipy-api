<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
