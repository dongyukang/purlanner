<?php

namespace App;

use App\Task;
use App\Term;
use Carbon\Carbon;
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
        'firstname', 'lastname', 'email', 'password', 'term_id'
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
     * User has many sub-tasks.
     */
    public function subtasks()
    {
      return $this->hasMany('App\SubTask');
    }

    /**
     * Get user's subtasks.
     *
     * @return array
     */
    public function getSubTasks()
    {
      date_default_timezone_set("America/New_York");

      return $this->subtasks()->whereDate('due_date', '>=', Carbon::today())->orderBy('due_date', 'asc')->get();
    }

    /**
     * User belongs to
     */
    public function notifications()
    {

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
        'due_date' => Carbon::parse($data['due_date'])->format('Y-m-d'),
        'note' => $data['note']
      ]);

      return $assignTask != null ? true : false;
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
     * Create default types. Exam, Assignment, Paper, Project
     *
     * @return boolean
     */
    public function createDefaultTypes()
    {
      /**
       * 'Exam' default type.
       *
       * @var $exam
       */
      $exam = $this->types()->create([
        'type_name' => 'exam'
      ]);

      /**
       * 'Assignment' default type.
       *
       * @var $assignment
       */
      $assignment = $this->types()->create([
        'type_name' => 'assignment'
      ]);

      /**
       * 'Paper' default type.
       *
       * @var $paper
       */
      $paper = $this->types()->create([
        'type_name' => 'paper'
      ]);

      /**
       * 'Project' default type.
       *
       * @var $project
       */
      $project = $this->types()->create([
        'type_name' => 'project'
      ]);

      if ($exam != null && $assignment != null && $paper != null && $project != null) return true;

      return false;
    }

    /**
     * Count number of tasks of given type name.
     * If tasks are past due, then it should not count as valid task.
     *
     * @param string $type_name
     * @return integer
     */
    public function countTask($type_name, $course_id = null)
    {
      date_default_timezone_set("America/New_York");

      if ($course_id != null) {
        return $this
              ->tasks()
              ->where('course_id', $course_id)
              ->where('type', strtolower($type_name))
              ->whereDate('due_date', '>=', Carbon::parse(date('m/d/Y')))
              ->count();
      }

      return $this
            ->tasks()
            ->where('type', strtolower($type_name))
            ->whereDate('due_date', '>=', Carbon::parse(date('m/d/Y')))
            ->count();
    }

    /**
     * Get types that have more than zero tasks.
     * If tasks are past due, then it should not count as task.
     *
     * @param integer $course_id
     * @return array
     */
    public function getNoneZeroTypes($course_id = null)
    {
      date_default_timezone_set("America/New_York");

      if ($course_id == null) {
        return collect($this->types()->get())->filter(function ($value, $key) {
          return $this->countTask($value->type_name) > 0;
        })->all();
      }

      return collect($this->tasks()->where('course_id', $course_id)->whereDate('due_date', '>=', Carbon::parse(date('m/d/Y')))->pluck('type')->unique()->all())->filter(function ($value, $key) {
        return $this->countTask($value) > 0;
      })->all();
    }

    /**
     * Set Term Id
     *
     * @param string $term_id
     * @return boolean
     */
    public function setTermId($term_id)
    {
      $this->term_id = $term_id;

      if ($this->save()) {
        return true;
      }

      return false;
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

        // return true;
      }

      // return false;
    }

    /**
     * Get My Courses.
     *
     * @return array $courses
     */
    public function getCourses()
    {
      $courses = array();

      foreach ($this->courses()->orderBy('subject', 'asc')->get() as $course) {
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

        // return true;
      }

      // return false;
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

    /**
     * Set time zone.
     *
     * @param string $timezone
     */
    protected function setTimeZone($timezone)
    {
      date_default_timezone_set($timezone);
    }

    /**
     * Tasks due tomorrow.
     *
     * @return array
     */
    public function tasksDueTomorrow()
    {
      $this->setTimeZone("America/New_York");

      return $this->tasks()->whereDate('due_date', Carbon::parse(date('m/d/Y'))->addDay(1))->get();
    }

    /**
     * Tasks due this week.
     *
     * @return array
     */
    public function tasksDueThisWeek()
    {
      $this->setTimeZone("America/New_York");

      return $this->tasks()
                  ->whereDate('due_date', '>=', Carbon::parse(date('m/d/y')))
                  ->whereDate('due_date', '<=', Carbon::parse(date('m/d/y'))->endOfWeek())
                  ->orderBy('due_date', 'asc')
                  ->get();
    }

    /**
     * Tasks due next week.
     *
     * @return array
     */
    public function tasksDueNextWeek()
    {
      $this->setTimeZone("America/New_York");

      return $this->tasks()
                  ->whereDate('due_date', '>=', Carbon::parse(date('m/d/y'))->addWeek(1)->startOfWeek())
                  ->whereDate('due_date', '<=', Carbon::parse(date('m/d/y'))->addWeek(1)->startOfWeek()->endOfWeek())
                  ->orderBy('due_date', 'asc')
                  ->get();
    }
}
