<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    /**
     * Fillable Attributes.
     *
     * @var array
     */
    protected $fillable = [
      'subject', 'course_number', 'course_title'
    ];

    /**
     * Course belongs to many users.
     */
    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
