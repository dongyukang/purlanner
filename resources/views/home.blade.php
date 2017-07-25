@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-4">
        <div class="panel panel-danger">
          <div class="panel-heading" style="text-align: center">
            <h4>Due Tomorrow</h4>
          </div>
          <div class="panel-body" style="text-align: center">
            <a href="#" data-toggle="modal" data-target="#taskDueTomorrow"><h2> {{ auth()->user()->tasksDueTomorrow()->count() }} </h2></a>
          </div>
        </div>
      </div>

      <div class="col-xs-4">
        <div class="panel panel-warning">
          <div class="panel-heading" style="text-align: center">
            <h4>Due This Week</h4>
          </div>
          <div class="panel-body" style="text-align: center">
            <a href="#" data-toggle="modal" data-target="#taskDueThisWeek"><h2>3</h2></a>
          </div>
        </div>
      </div>

      <div class="col-xs-4">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Due Next Week</h4>
          </div>
          <div class="panel-body" style="text-align: center">
            <a href="#" data-toggle="modal" data-target="#taskDueNextWeek"><h2>3</h2></a>
          </div>
        </div>
      </div>
    </div>

    @include('modals.tasks_due_tomorrow')
    @include('modals.tasks_due_this_week')
    @include('modals.tasks_due_next_week')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <div class="row">
          <div class="panel-heading" style="margin-top: -20px; text-align: left">
             <h3> My Courses </h3>
          </div>
          <div class="panel-body">
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
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h4>Today's Date at Purdue: {{ \Carbon\Carbon::today()->toFormattedDateString() }}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Exams <span class="badge">{{ collect(auth()->user()->exams())->count() }}</span></h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center"><strong> Course </strong></td>
                  <td style="text-align: center"><strong> Location </strong></td>
                  <td style="text-align: center"><strong> Date </strong></td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->exams() as $exam)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($exam->course_id)->subject . ' ' . \App\Course::find($exam->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ $exam->location }}</td>
                    <td style="text-align: center">{{ $exam->due_date }}</td>
                    <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Assignments <span class="badge">{{ collect(auth()->user()->assignments())->count() }}</span></h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center"><strong> Course </strong></td>
                  <td style="text-align: center"><strong> Assignment Title </strong></td>
                  <td style="text-align: center"><strong> Due Date </strong></td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->assignments() as $assignment)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($assignment->course_id)->subject . ' ' . \App\Course::find($assignment->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ $assignment->title }}</td>
                    <td style="text-align: center">{{ $assignment->due_date }}</td>
                    <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Papers <span class="badge">{{ collect(auth()->user()->papers())->count() }}</span></h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center"><strong> Course </strong></td>
                  <td style="text-align: center"><strong> Paper Title </strong></td>
                  <td style="text-align: center"><strong> Due Date </strong></td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->papers() as $paper)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($paper->course_id)->subject . ' ' . \App\Course::find($paper->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ $paper->title }}</td>
                    <td style="text-align: center">{{ $paper->due_date }}</td>
                    <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Projects <span class="badge">{{ collect(auth()->user()->projects())->count() }}</span></h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center"><strong> Course </strong></td>
                  <td style="text-align: center"><strong> Project Title </strong></td>
                  <td style="text-align: center"><strong> Due Date </strong></td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->projects() as $project)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($project->course_id)->subject . ' ' . \App\Course::find($project->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ $project->title }}</td>
                    <td style="text-align: center">{{ $project->due_date }}</td>
                    <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4>Other Tasks <span class="badge">{{ collect(auth()->user()->others())->count() }}</span></h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center"><strong> Course </strong></td>
                  <td style="text-align: center"><strong> Task Title </strong></td>
                  <td style="text-align: center"><strong> Task Type </strong></td>
                  <td style="text-align: center"><strong> Due Date </strong></td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->others() as $other)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($other->course_id)->subject . ' ' . \App\Course::find($other->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ $other->title }}</td>
                    <td style="text-align: center">{{ $other->type }}</td>
                    <td style="text-align: center">{{ $other->due_date }}</td>
                    <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
