@extends('layouts.app')

@section('content')
  <div class="container-fluid">

    @include('task_summary_dashboard')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <?php date_default_timezone_set("America/New_York"); ?>
        <h4>Today's Date in Purdue: {{ \Carbon\Carbon::parse(date("m/d/Y"))->toFormattedDateString() }}</h4>
      </div>
    </div>

    <div class="alert alert-info">
      This is a page that you are going to mark due dates or other important dates.    
    </div>

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <div class="row">
          <div class="panel-heading" style="margin-top: -20px; text-align: left;">
             <h3> My Courses </h3>
          </div>
          <div class="panel-body" style="background-color: white">

            <a href="{{ route('task') }}" @if (Route::currentRouteName() == 'task') class="btn btn-primary" @else class="btn btn-default" @endif>All</a>

            @foreach(auth()->user()->getCourses() as $course)
              <a href="/task/filter/{{ $course['Id'] }}" @if (Route::currentRouteName() == 'filter_task' && $course['Id'] == $course_id) class="btn btn-primary" @else class="btn btn-default" @endif >{{ $course['Subject'] . ' ' . $course['Number'] }}</a>
            @endforeach

          </div>
        </div>
        <hr />
          <a class="btn btn-success btn-block" style="padding: 12px" href="{{ route('create_task') }}"><span style="font-size: 18px;">New Task <span class="glyphicon glyphicon-plus"></span></span></a>
      </div>
    </div>

    <div class="container">
      @if (Route::currentRouteName() == 'task')
        @if (collect(auth()->user()->getNoneZeroTypes())->count() > 0)
          @include('tasks.tasks', [
            'types' => auth()->user()->getNoneZeroTypes()
          ])

        @else
          <center>
            <h4>Congradulations! You are not currently busy.</h4>
          </center>
        @endif

        <div style="text-align: center; margin-top: 25px;">
          <a class="btn btn-danger" href="{{ route('past_due_archives') }}">Past Due Archives</a>
        </div>

      @elseif (Route::currentRouteName() == 'filter_task')
        @if (collect(auth()->user()->getNoneZeroTypes($course_id))->count() > 0)
          @include('tasks.filter', [
            'types' => auth()->user()->getNoneZeroTypes($course_id),
            'course_id' => $course_id
          ])
        @else
          <center>
            <h4>Congradulations! You are not currently busy with this course.</h4>
          </center>
        @endif
      @endif
    </div>
  </div>

@endsection
