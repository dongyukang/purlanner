<?php

namespace App;

use DongyuKang\PurdueCourse\Facades\Purdue;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
  protected $table = 'terms';

  public function __construct()
  {
    if ($this->count() == 0 || ($this->term_id != null && $this->term_id != Purdue::currentTerm()->termId)) {
      $this->term_id = Purdue::currentTerm()->termId;
      $this->term_name = Purdue::currentTerm()->termName;
      $this->term_code = Purdue::currentTerm()->termCode;
      $this->term_begin = Purdue::currentTerm()->termBegin;
      $this->term_end = Purdue::currentTerm()->termEnd;
      $this->save();
    }
  }

  public function users()
  {
    return $this->belongsToMany('App\User', 'term_user', 'term_id');
  }
}
