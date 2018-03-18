<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
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
<body id="mainBody" class="fixed hold-transition skin-purple sidebar-mini">
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
                <a class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
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
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height: auto;">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ URL::asset($util->logo)}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{$user->firstName}} {{$user->lastName}}</p>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{(request()->is('dashboard') ? 'active' : '')}}">
                        <a href="{{url('/dashboard')}}">
                            <i class="fa fa-line-chart"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if($user->level==1)
                    <li class="header">MAINTENANCE</li>
                    <li class="{{(request()->is('gem') ? 'active' : '')}}"><a href="{{url('/gem')}}"><i class="fa fa-diamond"></i> <span>Gem</span></a></li>
                    <li class="{{(request()->is('jewelry') ? 'active' : '')}}"><a href="{{url('/jewelry')}}"><i class="fa fa-life-ring"></i> <span>Jewelry</span></a></li>
                    <li class="{{(request()->is('product') ? 'active' : '')}}"><a href="{{url('/product')}}"><i class="fa fa-shopping-cart"></i> <span>Product</span></a></li>                    
                    <li class="{{(request()->is('event') ? 'active' : '')}}"><a href="{{url('/event')}}"><i class="fa fa-bank"></i> <span>Event</span></a></li>                 
                    @endif
                    <li class="header">TRANSACTIONS</li>
                    <li class="header">QUERIES & REPORTS</li>
                    <li id="query"><a href="{{url('/query')}}"><i class="fa fa-bookmark-o"></i> <span>Queries</span></a></li>
                    <li id="report"><a href="{{url('/report')}}"><i class="fa fa-book"></i> <span>Reports</span></a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper" style="min-height: 941px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>@yield('title')</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div id="notification"></div>
                <div class="row">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </section>
            <!-- /.content -->
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
    <script src="{{ URL::asset('bootbox/bootbox.min.js')}}"></script>
    <script src="{{ URL::asset('js/moment.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function SuccessAlert(){
            $.ajax({
                type: "GET",
                url: "/success",
                success: function(data){
                    $('#notification').append(
                        '<div id="successAlert" class="alert alert-success alert-dismissible fade in">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-toggle="tooltip" title="Close">&times;</button>'+
                        '<h4><i class="icon fa fa-check"></i> Success!</h4>'+
                        data +
                    '</div>'
                    );
                }
            });
            setTimeout(function(){
                $('#successAlert').alert('close');
            },3000)
        }
        function ErrorAlert(){
            $.ajax({
                type: "GET",
                url: "/error",
                success: function(data){
                    $('#notification').append(
                        ' <div class="alert alert-danger alert-dismissible fade in">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-toggle="tooltip" title="Close">&times;</button>'+
                        '<h4><i class="icon fa fa-ban"></i> Something went wrong!</h4>'+
                        data +
                    '</div>'
                    );
                }
            });
        }
        function update() {
            $('#clock').html(moment().format('dddd - MMMM D, YYYY h:mm:ss A'));
        }
        setInterval(update, 1000);
        function rowFinder(row){
            if($(row).closest('table').hasClass("collapsed")) {
                var child = $(row).parents("tr.child");
                row = $(child).prevAll(".parent");
            } else {
                row = $(row).parents('tr');
            }
            return row;
        }
    </script>
    @yield('script')
</body>
</html>
