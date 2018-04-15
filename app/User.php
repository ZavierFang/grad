<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token','api_token','setting','followers_count','followings_count',
        'questions_count','comments_count','answers_count','likes_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //是否是本对象
    public function owns(Model $model){
        return $this->id==$model->user_id;
    }

    //用户--问题
    public function questions(){
        return $this->hasMany(Question::class);
    }

    //用户--答案
    public function answers(){
        return $this->hasMany(Answer::class);
    }

}
