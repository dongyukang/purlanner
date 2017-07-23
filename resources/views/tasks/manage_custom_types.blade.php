@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <a class="btn btn-primary" href="{{ route('create_task') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back to Add Task</a>
    <hr />
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="btn btn-primary" href="{{ route('create_custom_type') }}">Add New Custom Type</a>
      </div>
      <div class="panel-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <td>Type Name</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @foreach(auth()->user()->types()->get() as $type)
              <tr>
                <td>{{ $type->type_name }}</td>
                <td><a class="btn btn-danger" href="/task/type/{{ $type->id }}">Delete</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
