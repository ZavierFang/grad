<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/5/20
 * Time: 10:14
 */

namespace App\Repositories;

use App\User;


class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }

    //管理员获得所有用户
    public function getAllUsers(){
        return User::all();
    }
}