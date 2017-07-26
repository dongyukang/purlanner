@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    @include('task_summary_dashboard')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h4>My Tasks</h4>
      </div>
    </div>

    {{-- @foreach ($mytasks as $task)
      <div class="col-xs-6">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h5> <strong> {{ $task->title }} </strong> | Due: {{ $task->due_date }} ({{ ucwords(strtolower($task->type)) }}) </h5>
            {{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}
          </div>
          <div class="panel-body">
            <form role="form" action="{{ route('save_sub_task') }}" method="POST" style="margin: 0 auto; width: 90%">
              {{ csrf_field() }}
              <input type="hidden" name="task_id" value="{{ $task->id }}">
              <div class="row">
                <div class="col-xs-12">
                  <input name="sub_task" class="form-control" placeholder="Brief description about sub-task" required>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-12">
                  <div class="input-group date">
                    <input type="text" class="form-control" name="desire_date" required placeholder="Date you wish your sub-task to be completed"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>
                </div>
              </div>
              <br>
              <div class="row" style="text-align: center">
                <button type="submit" class="btn btn-primary"> Add Sub Task <span class="glyphicon glyphicon-plus"></span></button>
              </div>
            </form>
            <hr />
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
                  <td style="text-align :center"></td>
                  <td style="text-align :center"></td>
                  <td style="text-align :center"><a class="btn btn-primary btn-sm">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endforeach --}}
  </div>
@endsection
