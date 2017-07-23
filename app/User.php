<?php

namespace App;

use App\Term;
use App\Task;
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
     * User has many tasks.
     */
    public function tasks()
    {
      return $this->hasMany('App\Task');
    }

    /**
     * User has many custom types.
     */
    public function types()
    {
      return $this->hasMany('App\Type');
    }

    /**
     * Assign task to user.
     *
     * @param  array $data
     * @return boolean
     */
    public function assignTask($data)
    {
      $assignTask = $this->tasks()->create([
        'title' => $data['title'],
        'type'  => $data['type'],
        'course_id' => $data['course_id'],
        'location' => $data['location'],
        'due_date' => $data['due_date'],
        'note' => $data['note']
      ]);

      return $assignTask != null ? true : false;
    }

    /**
     * Return exams that user has.
     *
     * @return array
     */
    public function exams()
    {
      return collect($this->tasks()->get())
            ->where('type', 'exam')
            ->all();
    }

    /**
     * Return assignments that user has.
     *
     * @return array
     */
    public function assignments()
    {
      return collect($this->tasks()->get())
            ->where('type', 'assignment')
            ->all();
    }

    /**
     * Get user's papers.
     *
     * @return array
     */
    public function papers()
    {
      return collect($this->tasks()->get())
            ->where('type', 'paper')
            ->all();
    }

    /**
     * Return user's projects.
     *
     * @return array
     */
    public function projects()
    {
      return collect($this->tasks()->get())
            ->where('type', 'project')
            ->all();
    }

    /**
     * Get tasks of custom types of user.
     *
     * @param  string $custom_type
     * @return array
     */
    public function other($custom_type)
    {
      return collect($this->tasks()->get())
            ->where('type', $custom_type)
            ->all();
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
     * @return string
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
     * @return boolean $this->isCourseSet()
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
     *
     * @return array $courses
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
     * @return boolean
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
