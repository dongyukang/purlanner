@extends('layouts.app')

<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .top-left {
        position: absolute;
        left: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 40px;
    }

    .description {
        font-size: 20px;
        color: #919499;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

@section('content')
  <!-- Styles -->

  <div class="flex-center title" style="margin-bottom: 10px;">
    <strong> Let Your 'Rational Decision Maker' Drive The Wheel! </strong>
  </div>
  <div class="container" style="text-align: center; margin-bottom: 15px;">
    <div style="width=80%">
      <p class="description">
        A magical tool to help you avoid habit of waiting until the last minute. <br>
        Make time to do the things you should be doing.
      </p>
      <a class="btn btn-danger" href="{{ route('planner') }}" style="margin-top: 15px; margin-bottom: 15px;" onclick="showPleaseWait()">Proceed To Take My Journey</a>
      {{-- <button class="btn btn-warning" onclick="alertDevelopment()">Purdue Course Forum</button> --}}
    </div>
  </div>
  {{-- <script>
    function alertDevelopment() {
      alert("Sorry, I am still coding it.");
    }
  </script> --}}
  <center>
    <img src="{{ url('/img/rational_decision_maker.png') }}" width="600" style="margin-right: 40px;">
    {{-- <iframe src="https://embed.ted.com/talks/tim_urban_inside_the_mind_of_a_master_procrastinator" width="800px" height="480px" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe> --}}
  </center>
  <br>
  <center>
  </center>
  <div class="container" style="text-align: center">
    <div class="row">
      <div class="col-xs-4">
        <h4><i class="fa fa-pencil"></i> Write Tasks</h4>
        <p>
        </p>
      </div>
      <div class="col-xs-4">
        <h4><i class="fa fa-list-ol"></i> Write Sub Tasks</h4>
        <p>

        </p>
      </div>
      <div class="col-xs-4">
        <h4><i class="fa fa-camera-retro"></i> The Whole Picture</h4>
        <p>
        </p>
      </div>
    </div>
  </div>
@endsection
