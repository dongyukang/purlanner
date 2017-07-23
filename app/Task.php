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
   * Hidden Attributes.
   *
   * @var array
   */
  protected $hidden = [

  ];

}
