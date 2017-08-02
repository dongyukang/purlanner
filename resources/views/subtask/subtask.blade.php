@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    @include('task_summary_dashboard')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <center>
          <h4>My Tasks</h4>
        </center>
      </div>
    </div>

    @foreach ($mytasks as $task)
      <subtask
            task_data="{{ $task }}"
            course="{{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}">
      </subtask>
    @endforeach
  </div>
@endsection
