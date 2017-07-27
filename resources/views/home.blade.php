@extends('layouts.app')

@section('content')
  <div class="container-fluid">

    @include('task_summary_dashboard')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <h4>Today's Date: {{ \Carbon\Carbon::parse(date("m/d/Y"))->toFormattedDateString() }}</h4>
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
                    <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $exam->id }}">View</a></td>
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
                    <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $assignment->id }}">View</a></td>
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
                    <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $paper->id }}">View</a></td>
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
                    <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $project->id }}">View</a></td>
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
                    <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $other->id }}">View</a></td>
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
