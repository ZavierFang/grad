

@extends('layouts.app')

@section('content')
    {{--@include('vendor.ueditor.assets')--}}
    <div class="question-panel">
        <div class="question-wrapper">
            <div class="container">
                <div class="row">
                    <div class = "col-md-8 col-md-offset-1">
                        <div class="question-panel-main">
                            <h1 class="question-panel-title">
                                {{$question->title}}
                            </h1>
                            <div class="question-panel-detail">
                                {!! $question->body !!}
                            </div>
                            <div class="question-panel-footer">
                                <div class="question-panel-inner">
                                    <comments type="question"
                                        model="{{$question->id}}"
                                        count="{{$question->comments()->count()}}">
                                    </comments>
                                    @if(Auth::check())
                                        <question-like question="{{$question->id}}"></question-like>
                                        <a class="answer-item-action question-like" href="{{url("/questions/{$question->id}/follow")}}">
                                            <i class="fa fa-star fa-icon-sm"></i>关注
                                        </a>
                                    @endif

                                    @if(Auth::check() && Auth::user()->owns($question))
                                        <div class="ui actio-buttons">
                                            <a href="{{url("questions/$question->id/edit")}}"
                                               class="ui basic button green action-btn">编辑</a>
                                            <form action="{{url("/questions/$question->id")}}" method="post"
                                                  class="delete-form action-btn">
                                                {{method_field('DELETE')}}
                                                {!! csrf_field() !!}
                                                <button class="ui basic button red">删除</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        @if(Auth::check())
                            <div class="about-question">
                                <h2>{{ $question->followers_count }}</h2>
                                <span>关注者</span>
                            </div>
                            <div class="">
                                <question-follow-button question="{{$question->id}}"></question-follow-button>
                                <a href="#editor" class="btn btn-primary pull-right write-answer">
                                    写评论
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->answers_count}}条评论
                    </div>

                    @if($question->answers_count !== 0)
                        <div class="panel-body">

                            @foreach($question->answers as $answer)
                                <div class="media answer-item">
                                    <div class="media-body">
                                        <div class="answer-info-avatar">
                                            <img src="{{url("/image/{$answer->user->avatar}.png")}}">
                                        </div>
                                        <h4 class="media-heading answer-item-name">
                                            <a href="{{url("/person/{$answer->user->name}")}}">
                                                {{$answer->user->name}}
                                            </a>
                                        </h4>
                                        <div class="answer-item-content">
                                            {!! $answer->body !!}
                                        </div>
                                    </div>
                                    <div class="answer-item-time">
                                        发布于{{$answer->created_at->format('Y-m-d')}}
                                    </div>
                                    <div class="answer-item-actions">
                                        <user-vote-button
                                                answer="{{$answer->id}}"
                                                count="{{$answer->votes_count}}"
                                        >
                                        </user-vote-button>
                                        <comments type="answer"
                                                  model="{{$answer->id}}"
                                                  count="{{$answer->comments()->count()}}">
                                        </comments>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    @else
                        <div class="panel-body question-empty-panel">
                            <i>╮(╯∀╰)╭</i>
                            <span class="empty-tips">暂时还没有评论</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading about-author">
                        <h5>关于作者</h5>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img width="36" src="{{url("/image/{$question->user->avatar}.png")}}" alt="{{$question->user->name}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{url("/person/{$question->user->name}")}}">
                                        {{$question->user->name}}
                                    </a>
                                </h4>
                            </div>
                            <div class="user-statics">
                                <div class="statics-item text-center">
                                    <div class="statics-text">问题</div>
                                    <div class="statics-count">
                                        {{$question->user->questions_count}}
                                    </div>
                                </div>

                                <div class="statics-item text-center">
                                    <div class="statics-text">回答</div>
                                    <div class="statics-count">
                                        {{$question->user->answers_count}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        @if(Auth::check())
                            @if(Auth::id() !== $question->user->id)
                                <div class="$question-action-btns">
                                    <user-follow-button user="{{$question->user->id}}"></user-follow-button>
                                    <send-message user="{{$question->user->id}}"></send-message>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    @if(Auth::check())
                        <div class="panel-heading">
                            <div class="answer-info-panel">
                                <div class="answer-info-avatar">
                                    <img src="{{url("image/2.png")}}">
                                </div>
                                <div class="answer-content">{{\Auth::user()->name}}</div>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        @if(Auth::check())
                            <form action="{{url("/questions/$question->id/answer")}}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group{{$errors->has('body')?'has-error':''}}">
                                    <div id="container" name="body" type="text/plain" style="height:200">
                                        {!! old('body') !!}
                                    </div>
                                    @if($errors->has('body'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('body')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="ui button teal pull-right">提交评论</button>
                            </form>
                        @else
                            <a href="{{url("/login")}}" class="btn btn-success btn-block">登录后提交评论</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script>
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'}
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
@endsection