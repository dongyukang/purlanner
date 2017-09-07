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
      <a class="btn btn-danger" href="{{ route('planner') }}" style="margin-top: 15px; margin-bottom: 15px;" onclick="showPleaseWait()">Begin Using Purlanner</a>
    </div>
  </div>
  <center>
    <img src="{{ url('/img/rational_decision_maker.png') }}" width="600" style="margin-right: 40px;">
  </center>

  <center>
    <div class="container" style="margin-top: 45px; margin-bottom: -45px;">
      <div class="panel panel-default">
        <div class="panel-heading" style="text-align: center">
          <h4> Assignment <span class="badge"> 3 </span></h4>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <td style="text-align: center">Course</td>
                <td style="text-align: center">Title</td>
                <td style="text-align: center">Due Date</td>
                <td style="text-align: center"></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center">CS 18000</td>
                <td style="text-align: center">Assignment 1</td>
                <td style="text-align: center">09-12-2017</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="">View</a>
                </td>
              </tr>
              <tr>
                <td style="text-align: center">CS 24000</td>
                <td style="text-align: center">Assignment 2</td>
                <td style="text-align: center">09-12-2017</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="">View</a>
                </td>
              </tr>
              <tr>
                <td style="text-align: center">CS 49000</td>
                <td style="text-align: center">Assignment 3</td>
                <td style="text-align: center">09-12-2017</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="">View</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="container" style="margin-top: 45px; margin-bottom: 45px;">
      <div class="panel panel-default">
        <div class="panel-heading" style="text-align: center">
          <h4> Exam <span class="badge"> 2 </span></h4>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <td style="text-align: center">Course</td>
                <td style="text-align: center">Title</td>
                <td style="text-align: center">Due Date</td>
                <td style="text-align: center"></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center">CS 18000</td>
                <td style="text-align: center">Exam 1</td>
                <td style="text-align: center">09-12-2017</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="">View</a>
                </td>
              </tr>
              <tr>
                <td style="text-align: center">CS 24000</td>
                <td style="text-align: center">Exam 2</td>
                <td style="text-align: center">09-12-2017</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="">View</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </center>

  <div class="container" style="text-align: center; width: 80%">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2>About Purlanner</h2>
      </div>
      <div class="panel-body">
        <div class="container">
          <div class="row">
            <div class="col-xs-6">
              <h3><strong> <i class="fa fa-pencil"></i> Write Tasks </strong></h3>
              <p style="font-size: 15px;">
                It is a very first step for your academic journey. Writing Tasks can be described as marking your due dates for your big events like exams, papers, projects and etc. Purlanner will show you when are your important dates as various as possible,
                like by courses you are taking, by dates and by categories, such as 'exam' or 'assignment'.
              </p>
            </div>
            <div class="col-xs-6">
              <h3><strong> <i class="fa fa-list-ol"></i> Write Sub Tasks </strong></h3>
              <p style="font-size: 15px">
                Even if you are a very unskilled and clumsy procastinator, just knowing your big events may not strong enough to control your 'Instant Gratification Monkey'.
                Writing sub tasks is kinda like writing more specific processes each day to help you achieving a task. 
              </p>
            </div>
            {{-- <div class="col-xs-4">
              <h3><strong> <i class="fa fa-camera-retro"></i> The Whole Picture </strong></h3>
              <p style="font-size: 17px">
                Writing Sub tasks is very important as it shows you what to do for each day.
                However, how you manage to write proper amount of sub tasks is not easy. Without looking
                at the whole picture, you would make a mistake of putting so much works into one day, and gradually,
                you will end up thinking yourself, "Holy F*ck! I am not good at this kind of sh*t! I will give up."
              </p>
            </div> --}}
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
        {{-- <h3><strong> I believe that if you have clear set of lists of what to do today, then it is most likely you will finish the list. </strong></h3> --}}
        <iframe src="https://embed.ted.com/talks/tim_urban_inside_the_mind_of_a_master_procrastinator" width="100%" height="450px" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
      </div>
    </div>
  </div>
@endsection
