@extends('layouts.app')

@section('content')
  <div class="container">
    <settings subjects="{{ json_encode($subjects) }}" courses="{{ json_encode($courses) }}"></settings>
  </div>
@endsection
