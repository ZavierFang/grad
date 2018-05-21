<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //跳转个人设置页面
    public function index(){
        return view('users.setting');
    }

    //保存修改的设置
    public function store(Request $request){
        user()->settings()->merge($request->all());

        return back();
    }

    //修改头像
    public function change(){
        $code = user()->avatar;
        if(strcmp($code,"1")==0){
            user()->avatar = "5";
            user()->save();
        }else{
            user()->avatar = "1";
            user()->save();
        }
        return redirect('/');
    }
}
