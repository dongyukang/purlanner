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
            <form role="form" action="/" method="POST">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">All</button>

              @foreach(auth()->user()->getCourses() as $course)
                <button type="submit" class="btn btn-default">{{ $course['Subject'] . ' ' . $course['Number'] }}</button>
              @endforeach

            </form>
          </div>
        </div>
        <hr />
          <a class="btn btn-success btn-block" style="padding: 12px" href="{{ route('create_task') }}"><span style="font-size: 18px;">New Task <span class="glyphicon glyphicon-plus"></span></span></a>
      </div>
    </div>

    @foreach (auth()->user()->types()->get() as $type)
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center">
              <h4> {{ ucwords(strtolower($type->type_name)) }} <span class="badge">{{ auth()->user()->countTask($type->type_name) }}</span></h4>
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
                  @foreach (auth()->user()->tasks()->where('type', $type->type_name)->get() as $task)
                    <tr>
                      <td style="text-align: center"></td>
                      <td style="text-align: center">{{ $task->title }}</td>
                      <td style="text-align: center"></td>
                      <td style="text-align: center">
                        <a class="btn btn-primary" href="">View</a>
                      </td>
                    </tr>
                  @endforeach
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
@endsection
