@extends('layouts.app')

@section('content')
  <div class="container">
    @if (auth()->user()->isCurrentCourseEmpty())
      <setupcourses subjects="{{ json_encode($subjects) }}"></setupcourses>
    @else
      <h2>Welcome</h2>
    @endif
  </div>
@endsection
