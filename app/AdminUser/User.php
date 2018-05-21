<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/22
 * Time: 14:16
 */

namespace App\AdminUser;
use Auth;


class User
{
    public function info()
    {
        $user = Auth::user();
        return $user;
    }
}