<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class AdminController extends Controller
{

    public function __construct(UserRepository  $user)
    {
        $this->user = $user;
    }

    public function index(){
        return view('admin.main.index');
    }

    //系统用户信息--管理员
    public function userIndex(){
        $users = $this->user->getAllUsers();
        return view("admin.users.index",compact('users'));
    }


    //管理员删除用户
    public function destroy($id){
        $user = $this->user->byId($id);
        $user->delete();
        return redirect()->route('admin.users');
    }
}
