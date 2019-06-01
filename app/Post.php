<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'posts';


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
        'title',
        'description',
        'photo',
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
     * Relationship with comments table
     * @return Comment
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
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
     * Relationship with likes table
     * @return Tag
     */
    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }
}
