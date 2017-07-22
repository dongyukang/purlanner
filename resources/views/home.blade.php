@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <a class="btn btn-primary">Add New Task (+)</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h4><strong> Exams </storng></h4>
          </div>
          <div class="panel-body">
            <div class="col-xs-6">
              <h4>Total Exams Count</h4>
            </div>
            <div class="col-xs-6">
              <h4>0</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><strong> Assignments </strong></h4>
          </div>
          <div class="panel-body">
            <div class="col-xs-6">
              <h4>Total Assignments Count</h4>
            </div>
            <div class="col-xs-6">
              <h4>0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
