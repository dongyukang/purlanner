<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    /**
     * Course belongs to many users.
     */
    public function users()
    {
      return $this->belongsToMany('App\User', 'course_user', 'user_id');
    }
}
