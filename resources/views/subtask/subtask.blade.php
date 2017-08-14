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

    <div class="container">
      <div class="alert alert-info">
        This is a page where you write 'sub tasks'. <br>
        While 'Writing Task' is marking due dates, <br>
       'Writing sub-tasks' is writing what you will do each day
        to achieve the task.
      </div>
    </div>

    <subtask></subtask>
  </div>
@endsection
