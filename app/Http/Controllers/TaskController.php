<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show main task mage.
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
    return view('tasks.view');
  }

  /**
   * Save custom type to database.
   */
  public function saveCustomTypes(Request $request)
  {
    $this->validate($request, [
      'type_name' => 'required'
    ]);

    if (strcasecmp($request->get('type_name'), 'Exam') != 0 && strcasecmp($request->get('type_name'), 'Paper') != 0 &&
        strcasecmp($request->get('type_name'), 'Project') != 0 && strcasecmp($request->get('type_name'), 'Assignment') != 0 &&
        collect(auth()->user()->types()->get())->where('type_name', $request->get('type_name'))->first() == null) {
      $saveType = auth()->user()->types()->create([
        'type_name' => ucwords(strtolower($request->get('type_name')))
      ]);

      if ($saveType != null) {
        return redirect('/task/type');
      }
    }

    return redirect()->back();
  }

  /**
   * Assign task to user.
   *
   * @param  Request $request
   */
  public function assignTask(Request $request)
  {
    auth()->user()->assignTask($request->all());

    return redirect('/task');
  }

  /**
   * Delete custom type.
   */
  public function deleteCustomType($type_id)
  {
    if (auth()->user()->types()->find($type_id)->delete())
      return redirect()->back();
  }
}
