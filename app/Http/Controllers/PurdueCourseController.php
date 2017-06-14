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

  public function getCourseNumbers($subject)
  {
    $course_numbers = array();

    if ($subject != null) {
      foreach (Purdue::subject($subject)->getSubjectDetails() as $number) {
        array_push($course_numbers, $number['Number']);
      }
    }

    return json_encode($course_numbers);
  }

}
