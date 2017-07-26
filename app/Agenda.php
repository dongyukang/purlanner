<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
  /**
   * Fillable Attribute.
   */
  protected $fillable = [
    'task_id',
    'sub_task', // must be brief.
    'desire_date' // desire date for sub_task to be finished.
  ];

  /**
   * agenda belongs to a user.
   */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
