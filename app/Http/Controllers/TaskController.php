<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("America/New_York");

        $this->middleware(['auth', 'course_redirect_guard']);
    }

  /**
   * Show main task page.
   *
   * @return view
   */
    public function index()
    {
        return view('home');
    }

  /**
   * Show create task page.
   *
   * @return view
   */
    public function create()
    {
        return view('tasks.create');
    }

  /**
   * Manage Custom Types.
   *
   * @return view
   */
    public function showCustomTypes()
    {
        return view('tasks.manage_custom_types');
    }

  /**
   * Create Custom Types.
   */
    public function showCreateCustomTypes()
    {
        return view('tasks.add_custom_type');
    }

  /**
   * view task.
   *
   * @param  integer $id
   * @return view
   */
    public function showTask($id)
    {
        return view('tasks.view', [
        'task' => auth()->user()->tasks()->find($id)
        ]);
    }

  /**
   * Show past archives view.
   *
   * @return view
   */
    public function showPastArchives()
    {
        return view('tasks.past_due', [
        'tasks' => auth()->user()->tasks()
        ->whereDate('due_date', '<', \Carbon\Carbon::parse(date("m/d/Y")))
        ->orderBy('due_date', 'dec')->paginate(10)
        ]);
    }

  /**
   * Filter task by course id.
   */
    public function filterTask($course_id)
    {
        return view('home', [
        'course_id' => $course_id
        ]);
    }

  /**
   * Edit Task.
   *
   * @param  Request $request
   */
    public function editTask(Request $request, $task_id)
    {
        $user = auth()->user()->tasks()->find($task_id);

        $user->title = $request->get('title');
        $user->type = $request->get('type');
        $user->course_id = $request->get('course_id');
        $user->location = $request->get('location');
        $user->due_date = \Carbon\Carbon::parse($request->get('due_date'))->format('Y-m-d');
        $user->note = $request->get('note');

        if ($user->save()) {
            return redirect('/task')->with('flash', 'Your task has been successfully modified.')->with('type', 'info');
        }
    }

  /**
   * Save custom type to database.
   */
    public function saveCustomTypes(Request $request)
    {
        $this->validate($request, [
        'type_name' => 'required'
        ]);

        $type_name = strtolower($request->get('type_name'));

        if (!auth()->user()->types()->where('type_name', $type_name)->exists()) {
            $type_created = auth()->user()->types()->create([
            'type_name' => $type_name
            ]);

            if ($type_created != null) {
                  return redirect('/task/type')->with('flash', 'Type is successfully saved.')->with('type', 'info');
            }
        }

        return redirect('/task/type')->with('flash', 'Type already exists.')->with('type', 'danger');
    }

  /**
   * Assign task to user.
   *
   * @param  Request $request
   */
    public function assignTask(Request $request)
    {
        $result = auth()->user()->assignTask($request->all());

        if ($result) {
            // $mostRecentTask = auth()->user()->tasks()->get()->last()->id;

            return redirect('/task')->with('flash', 'Your task has been successfully saved.')->with('type', 'info');
        }

        return redirect('/task')->with('flash', 'Somehow I could not save your task.')->with('type', 'danger');
    }

  /**
   * Delete Task.
   *
   * @param  Request $request
   */
    public function deleteTask($task_id)
    {
        if (auth()->user()->tasks()->find($task_id)->delete()) {
            return redirect('/task')
            ->with('flash', 'Task is successfully deleted.')
            ->with('type', 'info');
        }
    }

  /**
   * Delete custom type.
   */
    public function deleteCustomType($type_id)
    {
        if (auth()->user()->types()->find($type_id)->delete()) {
            return redirect()->back()->with('flash', 'Type is successfully deleted!')->with('type', 'info');
        }
    }

  /**
   * Get tasks from today.
   *
   * @return array
   */
    public function getTasksFromToday()
    {
        return auth()->user()->tasks()
                             ->whereDate('due_date', '>=', \Carbon\Carbon::today())
                             ->orderBy('due_date', 'asc')
                             ->get();
    }

    /**
     * Return tasks with actual related course name.
     *
     * @return array
     */
    public function getTasksFromTodayWithCourseName()
    {
      /*
        "id": 24,
        "user_id": 1,
        "course_id": 6,
        "title": "Quiz #2",
        "type": "quiz",
        "due_date": "2017-09-07",
        "note": null,
        "location": null,
       */

      $tasks = array();

      $tasksOrdered = $this->getTasksFromToday();

      foreach ($tasksOrdered as $task) {
        array_push($tasks, [
          'id'          => $task->id,
          'user_id'     => $task->user_id,
          'course'      => \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number,
          'title'       => $task->title,
          'type'        => $task->type,
          'due_date'    => $task->due_date,
          'note'        => $task->note,
          'location'    => $task->location
        ]);
      }

      return $tasks;
    }
}
