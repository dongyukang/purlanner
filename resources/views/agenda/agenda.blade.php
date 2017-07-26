@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    @include('task_summary_dashboard')

    <div class="container">
      <div class="alert alert-info">
        <center> This section is to set 'Sub-Tasks' to complete a 'Task'. </center>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h4>My Tasks</h4>
      </div>
    </div>

    @foreach ($mytasks as $task)
      <div class="col-xs-6">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h5> {{ $task->title }} | Due: {{ $task->due_date }} ({{ ucwords(strtolower($task->type)) }}) </h5>
          </div>
          <div class="panel-body">
            <center>
              <a class="btn btn-primary btn-sm"> Add Sub Task <span class="glyphicon glyphicon-plus"></span></a>
            </center>
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align :center">Sub-Task</td>
                  <td style="text-align :center">Desire Due</td>
                  <td style="text-align :center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align :center">Read pg 23-45</td>
                  <td style="text-align :center">07-26-2017</td>
                  <td style="text-align :center"><a class="btn btn-primary btn-sm">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
