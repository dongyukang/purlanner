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
}
