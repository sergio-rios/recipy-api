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
        'image',
        'mime',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mime',
    ];

    public function setImageAttribute($value)
    {
        $data = explode(',', $value);
        $this->attributes['mime'] = $data[0];
        $this->attributes['image'] = base64_decode($data[1]);
    }


    public function getImageAttribute($value)
    {
        if (isset($value)) {
            $mime = $this->attributes['mime'];
            $data = base64_encode($value);
            return $mime.','.$data;
        }
        else {
            return null;
        }
    }


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
        return $this->belongsToMany('App\Tag', 'post_tags');
    }
}
