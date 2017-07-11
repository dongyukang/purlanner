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
}
