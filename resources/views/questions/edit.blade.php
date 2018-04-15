@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑帖子</div>

                    <div class="panel-body">
                        <form action="{{url("/questions/$question->id")}}" method="post">
                            {{method_field('PATCH')}}
                            {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('title')?'has-error':''}}">
                                <label for="title">
                                    标题
                                </label>
                                <input type="text" value="{{$question->title}}" name="title" class="form-control" placeholder="标题" id="title">
                                @if($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('title')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('body')? 'has-error':''}}">
                                <label for="body">描述</label>
                                <script id="container" name="body" type="text/plain" style="height:200px;">{!! $question->body !!}</script>
                                @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                                <button type="submit" class="btn btn-success pull-right">更新问题</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')<!-- 实例化编辑器 -->
     <script type="text/javascript">
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