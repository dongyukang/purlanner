@extends('layouts.app')

@section('content')
  <div class="container">
    <a class="btn btn-primary" href="{{ route('custom_type') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back to Manage Custom Type</a>
    <hr />
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>New Type</h4>
      </div>
      <div class="panel-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="form-horizontal" action="{{ route('save_custom_type') }}" method="POST">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-xs-2">
              <label><h5> Type Name </h5></label>
            </div>
            <div class="col-xs-9">
              <input class="form-control" name="type_name" placeholder="Type Name" required>
            </div>
          </div>
          <hr />
          <center>
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-danger" href="{{ route('custom_type') }}">Cancel</a>
          </center>
        </form>
      </div>
    </div>

  </div>
@endsection
