<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use DongyuKang\PurdueCourse\Facades\Purdue;

class PurdueCourseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Get current term name.
   *
   * @return string Purdue::currentTerm()->termName
   */
  public function getCurrentTermName()
  {
    return Purdue::currentTerm()->termName;
  }

  /**
   * Get subjects based on current term.
   *
   * @return array $subjects
   */
  public function getCurrentTermSubjects()
  {
    $subjects = array();

    foreach (Purdue::subjects() as $subject) {
      array_push($subjects, $subject['Abbreviation']);
    }

    return $subjects;
  }

  /**
   * Get course numbers based on $subject.
   *
   * @param  string $subject
   * @return array $course_numbers
   */
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

  /**
   * Get sections.
   *
   * @param string $course
   * @param string $title
   * @return array $sections
   */
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

  /**
   * Register Course.
   *
   * @param \Illuminate\Http\Request
   * @return boolean
   */
  public function saveCourse(Request $request)
  {
    return auth()->user()->saveCourse($request->all());
  }

  /**
   * Remove course from the list.
   *
   * @param \Illuminate\Http\Request
   * @return boolean
   */
  public function removeCourse(Request $request)
  {
    return auth()->user()->removeCourse($request->get('course_id'));
  }
}
