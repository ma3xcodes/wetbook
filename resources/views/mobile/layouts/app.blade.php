<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($tab_title) ? $tab_title : config('app.name', APP_NAME) }}</title>
    @section('styles')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-helper.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('plugins/izitoast/dist/css/iziToast.css') }}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap-offcanvas/css/bootstrap.offcanvas.min.css')}}">
    @show
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top helper-navbar-color {{((new Mobile_Detect())->isMobile())?'navbar-fixed-top':''}}">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle offcanvas-toggle {{Auth::check() ? 'pull-left margin-left' : ''}}" data-toggle="offcanvas" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if(Auth::check())
                    <div class="navbar-left pull-right">
                        <div class="dropdown" style="display: inline-block;">
                            <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="icon icon-bell-alt"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" style="left: auto;right: .1px;top: 105%;  ">
                                <li>
                                    <a href="#">
                                        link 1
                                    </a>
                                    <a href="#">
                                        link 2
                                    </a>
                                    <div class="divider"></div>
                                    <a href="#">
                                        Ver todas
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="navbar-brand">
                            <span class="icon icon-comments"></span>
                        </a>
                    </div>
                    @endif
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('assets/logo/white-logo.png')}}" alt="" class="head-logo"> {{ SHORT_NAME }}
                    </a>
                </div>

                <div class="collapse navbar-offcanvas" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!--<ul class="nav navbar-nav">
                    &nbsp;
                    </ul>-->
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right aside-menu">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Ingresar</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        @else
                            <li>
                                <div class="aside-profile">
                                    <div>
                                        <a href="{{route('main.profile')}}">
                                            <img src="{{auth::user()->profile->avatar->photo_small}}" alt="avatar" class="thumbnail no-padding" width="40">
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('main.profile') }}">
                                            <span>{{auth::user()->first_name . " " . auth::user()->last_name}}</span>
                                            <small>{{ auth::user()->username }}</small>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="">
                                    Noticias <i class="icon icon-globe"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="">
                                    Fotos <i class="icon icon-picture"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="">
                                    Mensajes <i class="icon icon-comments"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="">
                                    Amigos <i class="icon icon-group"></i>
                                </a>
                            </li>
                            <li>
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
                            <!--<li class="dropdown">
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
                            </li>-->
                        @endif
                    </ul>

                    @if(Auth::check())
                        <form class="navbar-form navbar-left" style="margin-top: 10px;">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" placeholder="Search">
                                <p class="no-margin">
                                    <small>Press enter to search</small>
                                </p>
                            </div>
                            <!--<button type="submit" class="btn btn-default btn-sm">
                                <i class="icon icon-search"></i>
                            </button>-->
                        </form>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <div class="loading ">
        <div class="loader"></div>
    </div>

    @section('scripts')
        <!-- Scripts -->
        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{asset('plugins/izitoast/dist/js/iziToast.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-offcanvas/js/bootstrap.offcanvas.min.js')}}"></script>
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
