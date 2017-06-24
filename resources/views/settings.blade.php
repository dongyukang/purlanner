@extends('layouts.app')

@section('content')
  <div class="container">
    <settings subjects="{{ json_encode($subjects) }}"></settings>
  </div>
  {{-- <setupcourses subjects="{{ json_encode($subjects) }}"></setupcourses> --}}

@endsection
