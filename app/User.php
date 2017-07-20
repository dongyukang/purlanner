<?php

namespace App;

use App\Term;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use DongyuKang\PurdueCourse\Facades\Purdue;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'term_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * User belongs to many courses.
     */
    public function courses()
    {
      return $this->belongsToMany('App\Course');
    }

    /**
     * Make sure that user belongs to term.
     *
     * @return boolean
     */
    public function isCurrentTermSet()
    {
      if ($this->getTermId() != 'null' && $this->getTermId() == Term::all()->last()->term_id) return true;

      return false;
    }

    /**
     * Return term id.
     *
     * @return String TermId
     */
    public function getTermId()
    {
      return $this->term_id;
    }

    /**
     * Set Term Id
     *
     * @param String TermId
     * @return Boolean Saved
     */
    public function setTermId($term_id)
    {
      $this->term_id = $term_id;

      return $this->save();
    }

    /**
     * Check if user takes course(s).
     *
     * @return boolean
     */
    public function isCourseSet()
    {
      if ($this->courses()->count() > 0 && $this->isCurrentTermSet()) return true;

      return false;
    }

    /**
     * If courses for current term is empty.
     *
     * @return Boolean
     */
    public function isCurrentCourseEmpty()
    {
      return !$this->isCourseSet();
    }

    /**
     * Save Course into the database.
     *
     * @param  array $course_data
     * @return boolean
     */
    public function saveCourse($course_data)
    {
      // check if the course given already exists in the Course model.
      $exists = \App\Course::where('subject', $course_data['subject'])
                          ->where('course_number', $course_data['course_number'])
                          ->where('course_title', $course_data['course_title'])
                          ->first() != null ? true : false;

      // if course does not exist in the Course model, then create it.
      if (!$exists) {
        $course = \App\Course::create([
          'subject'       => $course_data['subject'],
          'course_number' => $course_data['course_number'],
          'course_title'  => $course_data['course_title']
        ]);
      } else {
        $course = \App\Course::where('subject', $course_data['subject'])
                            ->where('course_number', $course_data['course_number'])
                            ->where('course_title', $course_data['course_title'])
                            ->first();
      }

      // check if this user already has the course.
      // toggle to indicate that user belongs to the course id.
      if (!($this->courses()->find($course->id))) {
        $this->courses()->toggle($course->id);
        return true;
      }
      return false;
    }

    /**
     * Get My Courses.
     */
    public function getCourses()
    {
      $courses = array();

      foreach ($this->courses as $course) {
        array_push($courses, [
          'Id'      => $course->id,
          'Subject' => $course->subject,
          'Number'  => $course->course_number,
          'Title'   => $course->course_title
        ]);
      }

      return $courses;
    }

    /**
     * Remove course data.
     *
     * @param  integer $course_id
     * @return boolean
     */
    public function removeCourse($course_id)
    {
      // check if the course data exists in the database 'users' table.
      $exists = $this->courses()->find($course_id) != null ? true : false;

      // if exists, then detach it.
      if ($exists) {
        $this->courses()->toggle($course_id);
        return true;
      }
      return false;
    }

    /**
     * Find if user takes certain course.
     *
     * @return Boolean
     */
    public function takesCourse($course_data)
    {
      return collect($this->getCourses())
                     ->where('Subject', $course_data['subject'])
                     ->where('Number', $course_data['course_number'])
                     ->where('Title', $course_data['course_title'])
                     ->first() != null ? true : false;
    }
}
