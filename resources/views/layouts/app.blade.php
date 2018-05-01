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
    <link rel="stylesheet" href="{{ URL::asset('css/guest.css') }}">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @yield('headerScript')
</head>
<body id="mainBody" class="layout-top-nav">
    <div class="wrapper">
        <header class="main-header margin-bottom">
            <nav class="navbar navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{url('/')}}" class="navbar-brand">
                            <img src="{{ URL::asset($util->logo) }}" width:"48px" height="48px" style="display: inline-block!important;margin-top: -15px" class="img-circle" alt="Logo">                        
                            {{$util->name}}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{(request()->is('/') ? 'active' : '')}}"><a href="{{url('/')}}">Home</a></li>
                        <li class="{{(request()->is('events') ? 'active' : '')}}"><a href="{{url('/events')}}">Events</a></li>
                        <li class="{{(request()->is('collection') ? 'active' : '')}}"><a href="{{url('/collection')}}">Collection</a></li>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer class="main-footer footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 divider">
                        <h4>PERIODJEWELS</h4>
                        <p>All rights reserved Periodjewels Inc.</p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <p>9454 Wilshire Blvd Suite #M18 Beverly Hills, CA 90212</p>
                        <p>310.777.0360 | 310.777.0329</p>
                        <p>info@periodjewels.com | ronny@periodjewels.com</p>
                        © Periodjewels Inc.
                    </div>
                </div>
            </div>   
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
