<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
  /**
   * Fillable Attributes.
   */
    protected $fillable = [
    'task', 'task_id', 'due_date'
    ];

  /**
   * subtask belongs to task.
   */
    public function tasks()
    {
        return $this->belongsTo(\App\Task::class);
    }

    /**
     * Get course info from subtask id.
     *
     * @return string
     */
    public function getCourseFromSubTaskId($subtask_id)
    {
      $task_id = \App\SubTask::find($subtask_id)->task_id;

      $course_id = \App\Task::find($task_id)->course_id;

      $course_subject = \App\Course::find($course_id)->subject;

      $course_number = \App\Course::find($course_id)->course_number;

      return $course_subject . ' ' . $course_number;
    }

    /**
     * Get task from subtask id.
     *
     * @return string
     */
    public function getTaskFromSubTaskId($subtask_id)
    {
      $task_id = \App\SubTask::find($subtask_id)->task_id;

      $task = \App\Task::find($task_id)->title;

      return $task;
    }
}
