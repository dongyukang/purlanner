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
        A perfect tool to help you avoid habit of waiting until the last minute. <br>
        Make time to do the things you should be doing.
      </p>
      <a class="btn btn-danger" href="{{ route('planner') }}" style="margin-top: 15px; margin-bottom: 15px;" onclick="showPleaseWait()">Proceed To Take My Journey</a>
    </div>
  </div>
  <center>
    <img src="{{ url('/img/rational_decision_maker.png') }}" width="600" style="margin-right: 40px;">
  </center>
  <br>
  <div class="container-fluid" style="text-align: center">
    <div class="container">
      <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
        <h3><strong> I believe that if you have clear set of lists of what to do today, then it is most likely you will finish the list. </strong></h3>
        <iframe src="https://embed.ted.com/talks/tim_urban_inside_the_mind_of_a_master_procrastinator" width="100%" height="450px" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
      </div>
    </div>
    <div>
      <div class="container">
        <div class="row">
          <div class="col-xs-4">
            <h3><strong> <i class="fa fa-pencil"></i> Write Tasks </strong></h3>
            <p style="font-size: 17px">
              It is a very first step for your academic journey. Writing Tasks can be described as marking your due dates for your big events like exams, papers, projects and etc. Purlanner will show you when are your important dates as various as possible,
              like by courses you are taking, by dates and by categories, such as 'exam' or 'assignment'.
            </p>
          </div>
          <div class="col-xs-4">
            <h3><strong> <i class="fa fa-list-ol"></i> Write Sub Tasks </strong></h3>
            <p style="font-size: 17px">
              Even if you are a very unskilled and clumsy procastinator, just knowing your big events may not strong enough to control your 'Instant Gratification Monkey'.
              Writing sub tasks is kinda like writing more specific processes each day to help you achieving a task. For instance, if you have a homework 'Reading Chapter 1' due August 24th, then you can write your sub tasks like
              <ol>
                <li>
                  'August 20st - Read preface'
                </li>
                <li>
                  'August 21st - Read 10p ~ 20p'
                </li>
                <li>
                  'August 22st - Read 20p ~ 40p'
                </li>
                <li>
                  'August 23st - Write some summary for entire chapter 1'
                </li>
              </ol>
            </p>
          </div>
          <div class="col-xs-4">
            <h3><strong> <i class="fa fa-camera-retro"></i> The Whole Picture </strong></h3>
            <p style="font-size: 17px">
              Writing Sub tasks is very important as it shows you what to do for each day.
              However, how you manage to write proper amount of sub tasks is not easy. Without looking
              at the whole picture, you would make a mistake of putting so much works into one day, and gradually,
              you will end up thinking yourself, "Oh my god! I am not good at this kind of stuff! I gave up!"
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
