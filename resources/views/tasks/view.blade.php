@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <a class="btn btn-primary" href="{{ url()->previous() }}"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
    <hr />
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ $task->title }}</h4>
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
          <form role="form" class="form-horizontal" action="/task/edit/{{ $task->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-xs-1">
                <label><h5> Course* </h5></label>
              </div>
              <div class="col-xs-11">
                <select class="form-control" name="course_id">
                  @foreach(auth()->user()->getCourses() as $course)
                    <option value="{{ $course['Id'] }}" @if ($course['Id'] == $task->course_id) {{ 'selected' }} @endif>{{ $course['Subject'] . ' ' . $course['Number'] . ' ' . $course['Title'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Type* </h5></label>
              </div>
              <div class="col-xs-5">
                <select class="form-control" name="type">
                  @foreach(auth()->user()->types()->get() as $type)
                    <option value="{{ $type->type_name }}" @if ($type->type_name == $task->type) {{ 'selected' }} @endif>{{ ucwords(strtolower($type->type_name)) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Date* </h5></label>
              </div>
              <div class="col-xs-11">
                <div class="input-group date">
                  <input type="text" name="due_date" class="form-control" placeholder="When will it happen? or When is it due?" value="{{ \Carbon\Carbon::parse($task->due_date)->format('m/d/Y') }}" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Title* </h5></label>
              </div>
              <div class="col-xs-11">
                <input class="form-control" name="title" placeholder="Brief description about this task. ex) Read chapter 2." value="{{ $task->title }}" required>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Location </h5></label>
              </div>
              <div class="col-xs-11">
                <input class="form-control" name="location" value="{{ $task->location }}" placeholder="Location">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label><h5> Note </h5></label>
              </div>
              <div class="col-xs-11">
                <textarea class="form-control" rows="7" name="note" placeholder="Note">{{ $task->note }}</textarea>
              </div>
            </div>
            <hr />
            <center>
              <button type="submit" class="btn btn-success" onclick="showPleaseWait()">Save</button>
              <a href="/task/delete/{{ $task->id }}" class="btn btn-warning" onclick="showPleaseWait()">Delete</a>
              <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
