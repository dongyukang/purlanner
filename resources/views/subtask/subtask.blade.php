@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    {{-- @include('task_summary_dashboard') --}}

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <?php date_default_timezone_set("America/New_York"); ?>
        <h4>Today's Date in Purdue: {{ \Carbon\Carbon::parse(date("m/d/Y"))->toFormattedDateString() }} (<?php echo date('D'); ?>)</h4>
      </div>
    </div>

    <div class="container">
      <div class="alert alert-info">
        This is a page where you write 'sub tasks'. <br>
        While 'Writing Task' is marking due dates, <br>
       'Writing sub-tasks' is writing what you will do each day
        to achieve the task.
      </div>
    </div>

    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <center>
            <a class="btn btn-success btn-block btn-lg" href="/sub-task/create">Manage Sub-Tasks</a>
          </center>
        </div>
        <div class="panel-body">
          @todoExists
            @foreach (auth()->user()->getDatesOfSubTasks() as $date)
              <div class="row">
                <div class="col-xs-2">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <center>
                        <h4>{{ date('M', strtotime($date)) }}</h4>
                      </center>
                    </div>
                    <div class="panel-body">
                      <center>
                        <h4>{{ \Carbon\Carbon::parse($date)->day }} ({{ date('D', strtotime($date)) }})</h4>
                      </center>
                    </div>
                  </div>
                </div>
                <div class="col-xs-10">
                  <div class="panel panel-primary">
                    <div class="panel-body">
                      <ul>
                        @foreach (auth()->user()->subtasks()->get() as $subtask)
                          @if ($date == $subtask->due_date)
                            <li>
                              {{ $subtask->task }}
                              <span class="label label-primary">{{ $subtask->getTaskFromSubTaskId($subtask->id) }}</span>
                              <span class="label label-danger">{{ $subtask->getCourseFromSubTaskId($subtask->id) }}</span>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <hr />
            @endforeach
          @else
            <center> <h4> Nothing To Display </h4> </center>
          @endif
        </div>
      </div>
    </div>

  </div>
@endsection
