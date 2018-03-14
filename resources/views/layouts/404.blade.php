<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$util->name}} | @yield('title')</title>
    <link rel="icon" href="{{ URL::asset($util->logo) }}">
    <!-- Styles -->
    @yield('style')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/Site.css') }}">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body id="mainBody" class="layout-top-nav skin-purple">
    <div class="wrapper">
        <header class="main-header">
            <a href="{{url('/dashboard')}}" class="logo">
                <span class="logo-mini">
                    <b>
                        <img src="{{ URL::asset($util->logo) }}" width:"48px" height="48px" style="margin-top: -5px!important" class="img-circle" alt="User Image">
                    </b>
                </span>
                <span class="logo-lg"><b>{{$util->name}}</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                @if(\Auth::user())
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#" id="clock" class="text-white">...</a></li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ URL::asset($util->logo)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{$user->username}}</span>
                            </a>
                            <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ URL::asset($util->logo)}}" class="img-circle" alt="User Image">
                                <p>{{$user->firstName}} {{$user->lastName}}</p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </div>
                            </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endif
            </nav>
        </header>
        <div class="content-wrapper" style="min-height: 941px;">
            <section class="content-header">
                <h1>@yield('title')</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-page">
                            <h2 class="headline text-yellow"> 404</h2>

                            <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                            <h3>
                                We could not find the page you were looking for.
                                Meanwhile, you may return to <a href="{{url('/dashboard')}}">dashboard</a>.
                            </h3>
                            </div>
                            <!-- /.error-content -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <footer class="main-footer">
            <strong>Copyright © {{date('Y')}} <a href="http://facebook.com">Periodjewels</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ URL::asset('jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/js/adminlte.min.js')}}"></script>
    <script src="{{ URL::asset('admin-lte/js/demo.js')}}"></script>
    <script src="{{ URL::asset('js/moment.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        setTimeout(function(){
            $('#successAlert').alert('close');
        },4000)
        function update() {
            $('#clock').html(moment().format('dddd - MMMM D, YYYY h:mm:ss A'));
        }
        setInterval(update, 1000);
    </script>
    @yield('script')
</body>
</html>
