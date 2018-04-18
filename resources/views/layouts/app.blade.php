<?php
    use App\Utility;
    $util = Utility::find(1);
?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> | @yield('title')</title>
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
<body id="mainBody" class="layout-top-nav skin-purple">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{url('/')}}" class="navbar-brand">
                            <img src="{{ URL::asset($util->logo) }}" width:"48px" height="48px" style="display: inline-block!important;margin-top: -15px" class="img-circle" alt="Logo">                        
                            
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{(request()->is('/') ? 'active' : '')}}"><a href="{{url('/')}}">Home</a></li>
                        <li class="{{(request()->is('events') ? 'active' : '')}}"><a href="{{url('/events')}}">Events</a></li>
                        <li class="{{(request()->is('collections') ? 'active' : '')}}"><a href="{{url('/collections')}}">Collection</a></li>
                        <li  class="{{(request()->is('about') ? 'active' : '')}}"><a href="{{url('/about')}}">About</a></li>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>@yield('title')</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            @yield('content')          
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright © {{date('Y')}} <a href="https://www.instagram.com/periodjewels_inc/">Periodjewels</a>.</strong> All rights reserved.
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
