@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <a class="btn btn-primary" href="{{ route('planner') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back to My Tasks</a>
    <hr />
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>New Task</h4>
      </div>
      <div class="panel-body">
        <div class="container">
          <div class="alert alert-danger" role="alert">
            <ul>
              <li style="font-size: 15px;">
                Every field is required except Location and Note.
              </li>
            </ul>
          </div>
          <form role="form" class="form-horizontal" action="/task/create" method="POST">
            {{ csrf_field() }}

            <div class="row">
              <div class="col-xs-1">
                <label><h5> Type </h5></label>
              </div>
              <div class="col-xs-5">
                <select class="form-control" name="type">
                  @foreach(auth()->user()->types()->get() as $type)
                    <option value="{{ $type->type_name }}">{{ ucwords(strtolower($type->type_name)) }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-xs-5">
                {{-- <a class="btn btn-primary" href="{{ route('custom_type') }}">Manage Custom Type</a> --}}
                * You can manage types <a href="{{ route('custom_type') }}">here </a> or there <i class="fa fa-external-link-square"></i>
              </div>
            </div>
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
                <label><h5> Course </h5></label>
              </div>
              <div class="col-xs-11">
                <select class="form-control" name="course_id">
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
                <div class="input-group date">
                  <input type="text" name="due_date" class="form-control" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
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
                <textarea class="form-control" rows="7" name="note" placeholder="Note"></textarea>
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
