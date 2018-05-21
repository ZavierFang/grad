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
    <link rel="stylesheet" href="{{url('css/source/common.css')}}">
    <link rel="stylesheet" href="{{url('css/source/index.css')}}">
    @section('header-css')
        <link href="//cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.css" rel="stylesheet">
        <link href="{{url('css/source/ionicons.min.css')}}" rel="stylesheet">
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
                    <li class="ask-question"><a class="ui button blue" href="{{ url('news/index') }}"><i class="fa fa-paint-brush fa-icon-lg"></i>新闻资讯</a></li>
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
                                    <a href="http://localhost:8080/grad/public/person/{{Auth::user()->name}}"><i class="fa fa-user fa-icon-lg"></i>个人主页</a>
                                </li>
                                <li>
                                    <a href="{{url("/")}}"><i class="fa fa-cloud fa-icon-lg"></i>修改头像</a>
                                </li>
                                <li>
                                    <a href="{{url("/password")}}"><i class="fa fa-cog fa-icon-lg"></i>修改密码</a>
                                </li>
                                @if(Auth::user()->isAdmin(Auth::user()->id))
                                    <li>
                                        <a href="{{url("/admin")}}"> <i class="fa fa-coffee fa-icon-lg"></i>后台管理</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        注销
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
<div class="wrap">
    <div class="cBox01">
        <div class="c01">
            <div class="info-box">
                <div class="c01">
                    <div class="news-list">
                        <ul id="news-list-container">
                            @foreach($news as $eachnews)
                                <li class="news-li">
                                    <a target="_blank" rel="nofollow" href="{{$eachnews->news_url}}" class="news-link">
                                        <img src="{{$eachnews->imgPath}}" alt="无效图片" class="news-pic">
                                        <div class="news-content">
                                            <h3 class="news-title">{{$eachnews->news_title}}</h3>
                                            <span class="news-time">{{$eachnews->news_date}}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $('#flash-overlay-modal').modal();
</script>
</body>
</html>
