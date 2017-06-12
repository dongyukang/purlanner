@extends('layouts.app')

@section('content')
  <div class="container">
    @if (auth()->user()->firstAccess())
      <h2>First Access, We will set you up.</h2>
    @else
      <h2>Welcome</h2>
    @endif
  </div>
@endsection
