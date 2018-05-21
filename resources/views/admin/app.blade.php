@extends('admin.layouts.app')

{{--顶部导航--}}
@section('main-header')
    @inject('admin','App\AdminUser\User')
    <header class="main-header">
        <a href="{{url('/admin')}}" class="logo">
            <span class="logo-mini">Admin</span>
            <span class="logo-lg"><b>管理员界面</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </header>
@endsection

{{--主导航栏--}}
@section('main-sidebar')
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{url('image/4.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{$admin->info()->name}}</p>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="header">主导航栏</li>
                <li>
                    <a href="{{url('/admin')}}">
                        <i class="fa fa-dashboard"></i> <span>控制面板</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/news/update')}}">
                        <i class="fa fa-dashboard"></i> <span>更新资讯</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>用户管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                         </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/admin/users')}}"><i class="fa fa-circle-o"></i>用户</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>内容管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('admin/questions/index')}}"><i class="fa fa-circle-o"></i>问题</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
@endsection
