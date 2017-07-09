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
    'due_date', 'note', 'location', 'title', 'type'
  ];

  /**
   * Default Types.
   *
   * @var array
   */
  protected $defaultTypes = [
    'Exam', 'Assignment', 'Paper', 'Project', 'Study', 'Other'
  ];

  /**
   * Hidden Attributes.
   *
   * @var array
   */
  protected $hidden = [

  ];

  /**
   * Tasks belongs to many user.
   */
  public function users()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
}
