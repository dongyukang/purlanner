@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <a class="btn btn-primary" href="{{ route('task') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
    <hr />
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h4 style="color: white">Past Due Archives</h4>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="text-align: center">Course</td>
              <td style="text-align: center">Task Type</td>
              <td style="text-align: center">Title</td>
              <td style="text-align: center">Due Date</td>
              <td style="text-align: center"></td>
            </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $task)
              <tr>
                <td style="text-align: center">{{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}</td>
                <td style="text-align: center">{{ $task->type }}</td>
                <td style="text-align: center">{{ $task->title }}</td>
                <td style="text-align: center">{{ $task->due_date }}</td>
                <td style="text-align: center"><a class="btn btn-primary" href="/task/view/{{ $task->id }}">View</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <center> {{ $tasks->links() }} </center>
      </div>
    </div>
  </div>
@endsection
