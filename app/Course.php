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
        return $this->belongsToMany(\App\User::class);
    }

    /**
     * Get course id by subject, course number and title.
     *
     * @param string $subject
     * @param string $course_number
     * @param string $title
     * @return integer
     */
    public function getCourseId($subject, $course_number, $title)
    {
        return $this->where('subject', $subject)
                  ->where('course_number', $course_number)
                  ->where('course_title', $course_title)
                  ->first()
                  ->id;
    }
}
