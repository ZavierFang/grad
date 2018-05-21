<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Hash;

class PasswordController extends Controller
{
    //密码修改界面
    public function password(){
        return view('users.password');
    }

    public function update(ChangePasswordRequest $request){
        if(Hash::check($request->get('old_password'),user()->password)){
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('成功修改密码','success');
            return back();
        }

        flash('修改密码失败','danger');
        return back();
    }
}
