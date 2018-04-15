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
    <link href="{{ url('build/css/app-a9835dd9a9.css') }}" rel="stylesheet">
    @section('header-css')
        <link href="//cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.css" rel="stylesheet">
        <link href="{{url('css/source/ionicons.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{url('css/source/semantic.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{url('dist/css/_all-skins.min.css')}}">
    @show

<!-- Scripts -->
    <script>
        window.Laravel =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        Laravel.apiToken = "{{Auth::check()?'Bearer '.Auth::user()->api_token:'Bearer '}}";
        @if(Auth::check())
            window.Zhihu = {
            name: "{{Auth::user()->name}}",
            avatar: "{{Auth::user()->avatar}}"
        }
        @endif
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a class="nav-link-title" href="{{url('/')}}">首页</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="ask-question"><a class="ui button blue" href="{{ url('/questions/create') }}"><i class="fa fa-paint-brush fa-icon-lg"></i>新闻资讯</a></li>
                        <li class="ask-question"><a class="ui button blue" href="{{ url('/questions/create') }}"><i class="fa fa-paint-brush fa-icon-lg"></i>发帖子</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.config.js') }}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.all.js') }}"></script>
    <script>
        window.UEDITOR_CONFIG.serverUrl = '{{ config('ueditor.route.name') }}'
    </script>

    @yield('js')
</body>
</html>
