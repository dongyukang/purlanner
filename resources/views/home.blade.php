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

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <div class="row">
          <div class="panel-heading" style="margin-top: -20px; text-align: left;">
             <h3> My Courses </h3>
          </div>
          <div class="panel-body" style="background-color: white">

            <a href="{{ route('task') }}" class="btn btn-default">All</a>

            @foreach(auth()->user()->getCourses() as $course)
              <a href="/task/filter/{{ $course['Id'] }}" class="btn btn-default">{{ $course['Subject'] . ' ' . $course['Number'] }}</a>
            @endforeach

          </div>
        </div>
        <hr />
          <a class="btn btn-success btn-block" style="padding: 12px" href="{{ route('create_task') }}"><span style="font-size: 18px;">New Task <span class="glyphicon glyphicon-plus"></span></span></a>
      </div>
    </div>

    <div class="container">
      @foreach (auth()->user()->types()->get() as $type)
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center">
              <h4> {{ ucwords(strtolower($type->type_name)) }}</h4>
            </div>
            <div class="panel-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <td style="text-align: center">Course</td>
                    <td style="text-align: center">Title</td>
                    <td style="text-align: center">Due Date</td>
                    <td style="text-align: center"></td>
                  </tr>
                </thead>
                <tbody>
                  @if (Route::currentRouteName() == 'filter_task')
                    @foreach (auth()->user()->tasks()->where('type', $type->type_name)->where('course_id', $course_id)->whereDate('due_date', '>=', \Carbon\Carbon::parse(date("m/d/Y")))->get() as $task)
                      <tr>
                        <td style="text-align: center">{{ \App\Course::find($course_id)->subject . ' ' . \App\Course::find($course_id)->course_number }}</td>
                        <td style="text-align: center">{{ $task->title }}</td>
                        <td style="text-align: center">{{ $task->due_date }}</td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/task/view/{{ $task->id }}">View</a>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    @foreach (auth()->user()->tasks()->where('type', $type->type_name)->whereDate('due_date', '>=', \Carbon\Carbon::parse(date("m/d/Y")))->get() as $task)
                      <tr>
                        <td style="text-align: center">{{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}</td>
                        <td style="text-align: center">{{ $task->title }}</td>
                        <td style="text-align: center">{{ $task->due_date }}</td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/task/view/{{ $task->id }}">View</a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
              <center>
                <a class="btn btn-danger" href="#">Past Due Archive</a>
              </center>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection
