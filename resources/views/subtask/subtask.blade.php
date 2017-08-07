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

    <div class="container jumbotron">
      @foreach ($mytasks as $task)
        <subtask
              task_data="{{ $task }}"
              active_id="{{ $active_id }}"
              course="{{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}">
        </subtask>
      @endforeach
    </div>
  </div>
@endsection
