@extends('layouts.app')

@section('content')
  <div class="container">
    @if (auth()->user()->isCurrentCourseEmpty())
      {{-- <div class="panel panel-default">
        <div class="panel-heading">
          <h4>{{ $termName }}</h4>
        </div>

        <div class="panel-body" style="text-align: center;">
          <form id="submitcourse" method="post" action="{{ route('test') }}">
            {{ csrf_field() }}
            <select class="selectpicker_subject" data-live-search="true" onchange="chooseCourseNumber()" required>
              <option value="default">Choose a subject</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject }}">{{ $subject }}</option>
              @endforeach
            </select>

            <select class="selectpicker_number" data-live-search="true" required>
              <option value="default">Choose a course number</option>
              <option vale="18000">18000</option>
            </select>

            <select class="selectpicker_section" data-live-search="true" required>
              <option value="default">Choose a section</option>
              <option value="123">123</option>
            </select>

            <button type="submit" class="btn btn-primary" id="addcourse">Add Course ( + )</button>
          </form>
        </div>
      </div> --}}

      <setupcourses subjects="{{ json_encode($subjects) }}"></setupcourses>
    @else
      <h2>Welcome</h2>
    @endif
  </div>
@endsection
