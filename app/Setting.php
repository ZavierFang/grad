<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/19
 * Time: 23:40
 */

namespace App;


class Setting
{
    protected $array = ['city','qq','sex','brief'];
    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function merge(array $attributes){
        $settings = array_merge($this->user->setting,array_only($attributes,$this->array));
        return $this->user->update(['setting'=>$settings]);
    }
}