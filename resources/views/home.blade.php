@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <a class="btn btn-success" href="{{ route('create_task') }}">New Task (+)</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Exams</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h4>Total Exams Count </h4>
              </div>
              <div class="col-xs-6">
                <h4>0</h4>
              </div>
            </div>
            <hr>
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Location</td>
                  <td style="text-align: center">Date</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center">MA 16100</td>
                  <td style="text-align: center">Classroom</td>
                  <td style="text-align: center">07/25/2017</td>
                  <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Assignments</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h4>Total Assignments Count </h4>
              </div>
              <div class="col-xs-6">
                <h4>0</h4>
              </div>
            </div>
            <hr />
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Assignment Detail</td>
                  <td style="text-align: center">Due Date</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center">MA 161</td>
                  <td style="text-align: center">Solve 12, 25, 33 and read chapter 12, 14, 26</td>
                  <td style="text-align: center">08/1/2017</td>
                  <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Papers</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h4>Total Papers Count </h4>
              </div>
              <div class="col-xs-6">
                <h4>0</h4>
              </div>
            </div>
            <hr />
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Paper Title</td>
                  <td style="text-align: center">Due Date</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Projects</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h4>Total Projects Count </h4>
              </div>
              <div class="col-xs-6">
                <h4>0</h4>
              </div>
            </div>
            <hr />
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Project Title</td>
                  <td style="text-align: center">Due Date</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Other Tasks</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h4>Total Count </h4>
              </div>
              <div class="col-xs-6">
                <h4>0</h4>
              </div>
            </div>
            <hr />
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Task Title</td>
                  <td style="text-align: center">Task Type</td>
                  <td style="text-align: center">Due Date</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"></td>
                  <td style="text-align: center"><a class="btn btn-primary">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
