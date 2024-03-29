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
                  @if (Route::current()->uri != 'login' && Route::current()->uri != 'register' && Route::current()->uri != 'password/reset' && Route::current()->uri != '/')
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav" style="font-size: 15px; margin-top: 5px;">
                      <li><a href="{{ route('task') }}"  @if (Route::currentRouteName() == 'task' || Route::currentRouteName() == 'filter_task') style="color: #f77456" @endif style="color: white">Tasks</a></li>
                      <li><a href="{{ route('sub-task') }}" @if (Route::currentRouteName() == 'sub-task' || Route::currentRouteName() == 'sub-task-active') style="color: #f77456" @endif style="color: white">Sub-Tasks</a></li>
                      <li><a href="{{ route('whole-picture') }}" @if (Route::currentRouteName() == 'whole-picture') style="color: #f77456" @endif style="color: white">Whole Picture</a></li>
                    </ul>
                  @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (auth()->guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            {{-- <li>
                              <div style="margin-top: 20px">
                                <notification-button></notification-button>
                              </div>
                            </li> --}}
                            <li class="dropdown" style="margin-right: 10px; margin-top: 5px;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size: 15px;">
                                  {{ auth()->user()->firstname }}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    {{-- <li>
                                      <a href="{{ route('api') }}">API</a>
                                    </li> --}}
                                    <li>
                                      <a href="{{ route('settings') }}" onclick="showPleaseWait()">Settings</a>
                                    </li>
                                    @if (Route::current()->uri != '/')
                                      <li>
                                        <a href="{{ route('custom_type') }}">Manage Type</a>
                                      </li>
                                    @endif
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

        <flash message="{{ session('flash') }}" type="{{ session('type') }}"></flash>
    </div>
    <hr width="80%"/>
    <div class="container">
      <center>
        <div class="row" style="margin-bottom: 25px;">
          <center><h4 style="color: #a4a6a8">Purlanner</h4></center>
        </div>
        <div class="row">
          {{-- <span style="font-size: 15px;">Developed By <a href="https://www.facebook.com/dongyu.kang.39" target="_blank">Dongyu Kang</a>.</span> --}}
        </div>
      </center>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        /**
       * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
       */
      function showPleaseWait() {
          var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
              <div class="modal-dialog">\
                  <div class="modal-content">\
                      <div class="modal-header">\
                          <h4 class="modal-title" style="text-align: center">Please wait... It may take a while.</h4>\
                      </div>\
                      <div class="modal-body">\
                        <center> <i class="fa fa-refresh fa-spin fa-5x"></i> </center>\
                      </div>\
                  </div>\
              </div>\
          </div>';
          $(document.body).append(modalLoading);
          $("#pleaseWaitDialog").modal("show");
      }

      /**
       * Hides "Please wait" overlay. See function showPleaseWait().
       */
      function hidePleaseWait() {
          $("#pleaseWaitDialog").modal("hide");
      }
      $('.input-group.date').datepicker({
        todayHighlight: true
      });
    </script>
</body>
</html>
