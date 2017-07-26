<?php

namespace App\Http\Controllers;

use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DongyuKang\PurdueCourse\Facades\Purdue;

class PlannerController extends Controller
{
  /**
   * Constructor
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->isCurrentCourseEmpty()) {
      auth()->user()->setTermId(Term::all()->last()->term_id);
      return redirect('settings');
    } else {
      // TODO: if tasks and agenda is not empty, then go to 'whole picture'.
      // else if tasks is not empty, but agenda is empty, then go to 'agenda'.
      // else tasks is empty then go to 'tasks'.
      $isTaskEmpty = auth()->user()->tasks()->count() == 0 ? true : false;
      $isAgendaEmpty = auth()->user()->agendas()->count() == 0 ? true : false;

      return redirect('/task');

    }
  }

  /**
   * Show settings page
   *
   * @return \Illuminate\Http\Response
   */
  public function showSettings()
  {
    $subjects = array();
    $courses = auth()->user()->getCourses();

    foreach (Purdue::subjects() as $subject) {
      array_push($subjects, $subject['Abbreviation']);
    }

    return view('settings', [
      'termName' => Purdue::currentTerm()->termName,
      'subjects' => $subjects,
      'courses'  => $courses
    ]);
  }

  /**
   * show agenda
   *
   * @return view
   */
  public function showAgenda()
  {
    return 'agenda';
  }
}
