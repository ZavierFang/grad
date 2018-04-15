<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=['user_id','question_id','body','is_first'];

    //评论--用户
    public function user(){
        return $this->belongsTo(User::class);
    }

    //评论--帖子
    public function question(){
        return $this->belongsTo(Question::class);
    }

    //评论--评论
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
}
