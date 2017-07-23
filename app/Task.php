<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $table = 'tasks';

  /**
   * Fillable Attributes.
   *
   * @var array
   */
  protected $fillable = [
    'due_date', 'course_id', 'note', 'location', 'title', 'type'
  ];

  /**
   * Default Types.
   *
   * @var array
   */
  protected $defaultTypes = [
    'Exam', 'Assignment', 'Paper', 'Project', 'Other'
  ];

  /**
   * Hidden Attributes.
   *
   * @var array
   */
  protected $hidden = [

  ];

}
