@extends('layouts.app')

@section('content')
  <div class="container">
    <setupcourses subjects="{{ json_encode($subjects) }}"></setupcourses>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4> Personal Settings </h4>
      </div>
      <div class="panel-body">

      </div>
    </div>
  </div>
@endsection
