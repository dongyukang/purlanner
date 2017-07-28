@extends('layouts.app')

@section('content')
  <div class="container-fluid">

    @include('task_summary_dashboard')

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; background-color: white;">
        <?php date_default_timezone_set('EST'); ?>
        <h4>Today's Date: {{ \Carbon\Carbon::parse(date("m/d/Y"))->toFormattedDateString() }}</h4>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <div class="row">
          <div class="panel-heading" style="margin-top: -20px; text-align: left;">
             <h3> My Courses </h3>
          </div>
          <div class="panel-body" style="background-color: white">
            <form role="form" action="/" method="POST">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">All</button>

              @foreach(auth()->user()->getCourses() as $course)
                <button type="submit" class="btn btn-default">{{ $course['Subject'] . ' ' . $course['Number'] }}</button>
              @endforeach

            </form>
          </div>
        </div>
        <hr />
          <a class="btn btn-success btn-block" style="padding: 12px" href="{{ route('create_task') }}"><span style="font-size: 18px;">New Task <span class="glyphicon glyphicon-plus"></span></span></a>
      </div>
    </div>

    @foreach (auth()->user()->types()->get() as $type)
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <h4> {{ ucwords(strtolower($type->type_name)) }} <span class="badge"></span></h4>
          </div>
          <div class="panel-body">
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
