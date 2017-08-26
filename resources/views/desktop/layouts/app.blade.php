<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($tab_title) ? $tab_title : config('app.name') }}</title>
    @section('styles')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-helper.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{asset( 'css/'.(new \App\Libraries\Checks())->get_device_type().'.css' )}}" rel="stylesheet">
        <link href="{{ asset('plugins/izitoast/dist/css/iziToast.css') }}" rel="stylesheet">
    @show
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top helper-navbar-color helper-navbar-color-desktop">
            <div class="container">
                <div class="navbar-header">

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('assets/logo/white-logo.png')}}" alt="" class="head-logo"> {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!--<ul class="nav navbar-nav">
                    &nbsp;
                    </ul>-->
                    @if(Auth::check())
                    <form class="navbar-form navbar-left" style="margin-top: 10px;">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="icon icon-search"></i>
                        </button>
                    </form>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Ingresar</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        @else
                            <li>
                                <a href="#">
                                    <span class="icon icon-bell-alt"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon icon-comments"></span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{asset(auth::user()->profile->avatar->photo_small)}}" alt="profile-avatar" width="20" class="head-profile-avatar"> {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('main.profile')}}">
                                            Perfil
                                        </a>
                                        <a href="#">
                                            Configuracion
                                        </a>
                                        <div class="divider"></div>
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

        @yield('content')
    </div>

    @section('scripts')
        <!-- Scripts -->
        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{asset('plugins/izitoast/dist/js/iziToast.js')}}"></script>
        <script>
            (function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })();
        </script>
    @show
</body>
</html>
