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
        'name', 'email', 'password', 'city','qq','sex','brief','avatar', 'confirmation_token','api_token','setting','followers_count','followings_count',
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

    protected $casts = [
        'setting'=>'array'
    ];

    //是否是本对象
    public function owns(Model $model){
        return $this->id==$model->user_id;
    }

    //用户--问题
    public function questions(){
        return $this->hasMany(Question::class);
    }

    //用户--管理员
    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function isAdmin($id){
        $result = Admin::where('user_id',$id)->get();
        return !$result->isEmpty();
    }

    //用户--答案
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function settings()
    {
        return new Setting($this);
    }

    //用户--问题--多对多
    public function follow(){
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    //用户关注某个问题
    public function followQuestion($questionId){
        return $this->follow()->toggle($questionId);
    }

    //用户是否关注某个问题
    public function followed($questionId){
        return $this->follows()->where('question_id',$questionId)->count();
    }
}
