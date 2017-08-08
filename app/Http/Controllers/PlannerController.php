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
      // if (auth()->user()->getTermId() == null) {
        auth()->user()->setTermId(Term::all()->last()->term_id);
      // }

      return redirect('/settings');
    } else {
      // TODO: if tasks and agenda is not empty, then go to 'whole picture'.
      // else tasks is empty then go to 'tasks'.
      date_default_timezone_set("America/New_York");

      $isTaskEmpty = auth()->user()->tasks()->whereDate('due_date', '>=', Carbon::today())->count() == 0 ? true : false;
      // $isSubTaskEmpty = auth()->user()->subtasks()->count() == 0 ? true : false;

      if (!$isTaskEmpty) {
        return redirect('/look-at-the-whole-picture');
      }

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
    // $subjects = array();
    //
    // foreach (Purdue::subjects() as $subject) {
    //   array_push($subjects, $subject['Abbreviation']);
    // }

    return view('settings', [
      'termName' => Purdue::currentTerm()->termName,
      // 'subjects' => $subjects
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
