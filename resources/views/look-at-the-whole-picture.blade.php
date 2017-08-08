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

    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Today's Todo List</h3>
        </div>
        <div class="panel-body">
          <h4>Tasks Due Today</h4>
          <ul class="list-group">
            @foreach (auth()->user()->tasks()->whereDate('due_date', \Carbon\Carbon::today())->get() as $task)
              <li class="list-group-item list-group-item-default">
                  <i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;
                  <strong><span style="font-size: 18px; color: red">
                  {{ $task->title }}
                </span></strong>
                - {{ \App\Course::find($task->course_id)->subject }}
                  {{ \App\Course::find($task->course_id)->course_number }}
              </li>
            @endforeach
          </ul>
          <hr />
          <h4>Sub-Tasks</h4>
          <ul class="list-group">
            @foreach (auth()->user()->subtasks()->whereDate('due_date', \Carbon\Carbon::today())->get() as $subtask)
              <li class="list-group-item list-group-item-default">
                <i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;
                <strong><span style="font-size: 18px; color: red">
                  {{ $subtask->task }}
                </span></strong>
                  ({{ auth()->user()->tasks()->find($subtask->task_id)->title }})
                  - {{ \App\Course::find(auth()->user()->tasks()->find($subtask->task_id)->course_id)->subject }}
                    {{ \App\Course::find(auth()->user()->tasks()->find($subtask->task_id)->course_id)->course_number }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
@endsection
