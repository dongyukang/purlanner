@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    {{-- @include('task_summary_dashboard') --}}

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <?php date_default_timezone_set("America/New_York"); ?>
        <h4>Today's Date in Purdue: {{ \Carbon\Carbon::parse(date("m/d/Y"))->toFormattedDateString() }}</h4>
      </div>
    </div>

    <div class="container-fluid">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3>Summary</h3>
        </div>
        <div class="panel-body">
          <h4>Tasks Due Today</h4>
          <ul class="list-group">
            @foreach (auth()->user()->tasks()->whereDate('due_date', \Carbon\Carbon::today())->get() as $task)
              <li class="list-group-item list-group-item-default">
                  <i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;
                  <strong><span style="font-size: 15px; color: red">
                  {{ $task->title }}
                </span></strong>
                - {{ \App\Course::find($task->course_id)->subject }}
                  {{ \App\Course::find($task->course_id)->course_number }}
              </li>
            @endforeach
          </ul>
          <hr />
          <h4>Todo List For Today</h4>
          <ul class="list-group">
            @foreach (auth()->user()->subtasks()->whereDate('due_date', \Carbon\Carbon::today())->get() as $subtask)
              <li class="list-group-item list-group-item-default">
                <i class="fa fa-circle-o" style="cursor: pointer" aria-hidden="true"></i>&nbsp;&nbsp;
                <strong><span style="font-size: 15px; color: red">
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

    <hr />

    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Overview This Month</h3>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td style="text-align: center">Day</td>
                <td style="text-align: center">Due/Event Date</td>
                <td style="text-align: center">Todo</td>
              </tr>
            </thead>
            <tbody>
              @for ($day = \Carbon\Carbon::today()->day; $day <= \Carbon\Carbon::today()->endOfMonth()->day; $day++)
                <tr>
                    <td style="text-align: center">
                      <h4>
                          @if (\Carbon\Carbon::today()->day == $day)
                            <span style="color: red">{{ $day }}</span>
                          @else
                            {{ $day }}
                          @endif
                     </h4>
                    </td>
                    {{-- Tasks --}}
                    <td>
                      @foreach(auth()->user()->tasks()->whereDate('due_date', '>=', \Carbon\Carbon::today())->get() as $task)
                        <ul>
                          @if (\Carbon\Carbon::parse($task->due_date)->day == $day)
                            <li>
                              <span style="color: red">
                                {{ $task->title }}
                              </span>
                            </li>
                          @endif
                        </ul>
                      @endforeach
                    </td>
                    {{-- SubTasks --}}
                    <td>
                      @foreach(auth()->user()->subtasks()->whereDate('due_date', '>=', \Carbon\Carbon::today())->get() as $subtask)
                        <ul>
                          @if (\Carbon\Carbon::parse($subtask->due_date)->day == $day)
                            <li>
                              {{ $subtask->task }}
                            </li>
                          @endif
                        </ul>
                      @endforeach
                    </td>
                </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection
