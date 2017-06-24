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
        array_push($course_numbers, [
          'Number' => $number['Number'],
          'Title'  => $number['Title']
        ]);
      }
    }

    return json_encode($course_numbers);
  }

  public function getSections($course, $title)
  {
    $cnt = 0;

    // if there are more than one course, there are several arrays.
    if (Purdue::course($course)->countCourses() > 1) {
      $courseIds = Purdue::course($course)->courseId;
      $sections = array();

      foreach (Purdue::course($course)->title as $t) {
        $cnt++;
        if ($t == $title) {
          break;
        }
      }

      $sections = Purdue::course($course)
      ->classesByCourseId($courseIds[$cnt])
      ->sections()
      ->excludeType('Lecture')
      ->getSections();
    } else {
      $sections = Purdue::course($course)
      ->classes()
      ->sections()
      ->excludeType('Lecuture')
      ->getSections();
    }

    return json_encode($sections);
  }

}
