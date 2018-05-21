<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/17
 * Time: 14:28
 */

namespace App\Repositories;

use App\News;

class NewRepository
{
    //获得所有资讯
    public function getNewsFeed(){
        return News::all();
    }

    //存储信息到数据库
    public function create(array $attributes){
        return News::create($attributes);
    }
}