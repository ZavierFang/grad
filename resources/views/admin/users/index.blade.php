@extends('admin.app')

@section('content')
    <div class="box box-primary">
        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
                <tbody>
                <!--tr-th start-->
                <tr>
                    <th>操作</th>
                    <th>昵称</th>
                    <th>邮箱</th>
                    <th>注册时间</th>
                    <th>更新时间</th>
                </tr>
                <!--tr-th end-->
                @foreach($users as $user)
                    <tr>
                        <td>
                            <form action="{{url("admin/user/$user->id")}}" method="post" class="delete-form action-btn" style="display: inline-block">
                                {{method_field('DELETE')}}
                                {!! csrf_field() !!}
                            <button style="font-size: 16px;color: #dd4b39;padding: 4px" class="ui button">
                                <i class="fa fa-fw fa-trash-o" title="删除"></i>
                            </button>
                            </form>
                        </td>
                        <td class="text-muted">{{$user->name}}</td>
                        <td class="text-muted">{{$user->email}}</td>
                        <td class="text-navy">{{$user->created_at}}</td>
                        <td class="text-navy">{{$user->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

