@extends('layouts.app')

@section('content')
  <div class="container">
    @if (auth()->user()->isCurrentCourseEmpty())
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4> {{ $termName }} </h4>
        </div>

        <div class="panel-body">
          <select class="selectpicker_subjects" data-live-search="true">
            <option select="selected" value="default">Choose a subject</option>
            @foreach ($subjects as $subject)
              <option value="{{ $subject['Abbreviation'] }}">{{ $subject['Abbreviation'] }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn btn-primary pull-right">Save Courses</button>
        </div>
      </div>
    @else
      <h2>Welcome</h2>
    @endif
  </div>
@endsection
