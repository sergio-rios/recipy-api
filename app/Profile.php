<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'profiles';


    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship with users table
     * @return User
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
