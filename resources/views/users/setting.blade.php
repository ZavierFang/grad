@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">个人设置</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/setting') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">居住地址</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{user()->setting['city'] }}" required>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                                <label for="qq" class="col-md-4 control-label">QQ</label>

                                <div class="col-md-6">
                                    <input id="site" type="text" class="form-control" name="qq" value="{{user()->setting['qq']}}" required>

                                    @if ($errors->has('qq'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                <label for="sex" class="col-md-4 control-label">性别</label>

                                <div class="col-md-6">
                                    <input id="github" type="text" class="form-control" name="sex" value="{{user()->setting['sex']}}" required>

                                    @if ($errors->has('sex'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('brief') ? ' has-error' : '' }}">
                                <label for="brief" class="col-md-4 control-label">个人简介</label>

                                <div class="col-md-6">
                                    <textarea id="bio" type="text" class="form-control" name="brief" required>{{user()->setting['brief']}}</textarea>

                                    @if ($errors->has('brief'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('brief') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        更改资料
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
