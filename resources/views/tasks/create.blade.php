@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>New Task</h4>
      </div>
      <div class="panel-body">
        <div class="container">
          <div class="alert alert-info" role="alert">
            <ul>
              <li>
                Title, Due Date, Course and Type is <strong> required. </strong>
              </li>
              <li>
                Location and Note is <strong> not required. </strong>
              </li>
            </ul>
          </div>
          <form role="form" class="form-horizontal" action="" method="POST">
            {{ csrf_field() }}

            <div class="row">
              <div class="col-xs-1">
                <label><h5> Title </h5></label>
              </div>
              <div class="col-xs-11">
                <input class="form-control" name="title" placeholder="Task Title" required>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Type </h5></label>
              </div>
              <div class="col-xs-11">
                <select class="form-control">
                  <option value="exam">Exam</option>
                  <option value="assignment">Assignment</option>
                  <option value="paper">Paper</option>
                  <option value="project">Project</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Other </h5></label>
              </div>
              <div class="col-xs-11">
                <input id="form_other" name="other" class="form-control" disabled placeholder="Other Task Type">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Course </h5></label>
              </div>
              <div class="col-xs-11">
                <select class="form-control">
                  @foreach(auth()->user()->getCourses() as $course)
                    <option value="{{ $course['Id'] }}">{{ $course['Subject'] . ' ' . $course['Number'] . ' ' . $course['Title'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Due Date </h5></label>
              </div>
              <div class="col-xs-11">
                <input type="date" class="form-control" name="due_date" required>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Location </h5></label>
              </div>
              <div class="col-xs-11">
                <input class="form-control" name="location" placeholder="Location">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Note </h5></label>
              </div>
              <div class="col-xs-11">
                <textarea class="form-control" rows="7"></textarea>
              </div>
            </div>
            <hr />
            <center>
              <button type="submit" class="btn btn-success">Save</button>
              <a class="btn btn-danger" href="{{ route('planner') }}">Cancel</a>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
