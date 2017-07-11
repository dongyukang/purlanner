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

  /**
   * Register Course.
   *
   * @param Request
   * @return Boolean
   */
  public function saveCourse(Request $request)
  {
    $data = $request->all();
    $course = Course::where('subject', $data['subject'])
    ->where('course_number', $data['number'])
    ->where('course_title', $data['title'])
    ->first();

    if ($course == null) {
      Course::create([
        'subject'       => $data['subject'],
        'course_number' => $data['number'],
        'course_title'  => $data['title']
      ]);

      $course = Course::where('subject', $data['subject'])
      ->where('course_number', $data['number'])
      ->where('course_title', $data['title'])
      ->first();
    }

    if (!auth()->user()->isCurrentTermSet()) {

    }

    if (auth()->user()->courses()->find($course->id) == null) {
      auth()->user()->courses()->toggle($course->id);
      Redis::publish('notify', 'update');
    }
  }

  /**
   * Remove course from the list.
   *
   * @return Boolean
   */
  public function removeCourse(Request $request)
  {
    auth()->user()->courses()->detach($request->get('course_id'));
    Redis::publish('notify', 'update');
  }
}
