@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <center> <a class="btn btn-primary" href="/sub-tasks"><i class="fa fa-arrow-left"></i> Back</a> </center>
  </div>
  <br><br>
  <create-subtask></create-subtask>
@endsection
