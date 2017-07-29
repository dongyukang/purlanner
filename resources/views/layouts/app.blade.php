<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script> --}}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('intro') }}" style="margin-top: 5px;">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        Purlanner
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  @if (Route::current()->uri != 'login' && Route::current()->uri != 'register' && Route::current()->uri != 'password/reset')
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav" style="font-size: 15px; margin-top: 5px;">
                      <li><a href="{{ route('task') }}"  @if (Route::currentRouteName() == 'task') style="color: #f77456" @endif style="color: black">1. Write Tasks</a></li>
                      <li><a href="{{ route('sub-task') }}" @if (Route::currentRouteName() == 'sub-task') style="color: #f77456" @endif style="color: black">2. Write Sub-Tasks For Each Task</a></li>
                      <li><a href="" style="color: black">3. Look At The Whole Picture</a></li>
                    </ul>
                  @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (auth()->guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                              <a style="cursor: pointer" data-toggle="modal" data-target="#notifications"><i class="fa fa-bell fa-2x"></i> <span class="badge" style="margin-bottom: 8px;">0</span></a>
                            </li>
                            <li class="dropdown" style="margin-right: 10px; margin-top: 5px;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size: 15px;">
                                  {{ auth()->user()->name }}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    {{-- <li>
                                      <a href="{{ route('api') }}">API</a>
                                    </li> --}}
                                    <li>
                                      <a href="{{ route('settings') }}">Settings</a>
                                    </li>
                                    <li>
                                      <a href="{{ route('custom_type') }}">Manage Type</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @include('notification')

        @yield('content')
    </div>
    <hr width="60%"/>
    <div class="container">
      <center>
        <div class="row" style="margin-bottom: 25px;">
          <center><h4 style="color: #a4a6a8">Purlanner</h4></center>
        </div>
        <div class="row">
          <div class="container">
            <ul id="footer" style="list-style-type: none; font-size: 15px;">
              <li style="display: inline; margin-right: 25px;">
                <a href="{{ route('task') }}"> 1. Write Tasks </a>
              </li>
              <li style="display: inline; margin-right: 25px;">
                <a href="{{ route('sub-task') }}"> 2. Write Sub-Tasks For Each Task </a>
              </li>
              <li style="display: inline; margin-right: 25px;">
                <a href=""> 3. Look At The Whole Picutre </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <span style="font-size: 15px;">COPYRIGHT © DONGYU KANG.</span>
        </div>
      </center>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
      $('.input-group.date').datepicker({
        todayHighlight: true
      });


    </script>
</body>
</html>
