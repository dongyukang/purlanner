<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DongyuKang\PurdueCourse\Facades\Purdue;

class PurdueCourseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function getCurrentTermName()
  {
    return Purdue::currentTerm()->termName;
  }

  public function getCurrentTermSubjects()
  {
    $subjects = array();

    foreach (Purdue::subjects() as $subject) {
      array_push($subjects, $subject['Abbreviation']);
    }

    return $subjects;
  }

}
