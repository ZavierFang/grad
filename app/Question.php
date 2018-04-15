<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/5
 * Time: 0:02
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    protected $fillable=['title','body','user_id','is_first'];

    //设置问题显示
    public function isHidden()
    {
        return $this->is_hidden === 'T';
    }

    //帖子--答案
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    //帖子--用户
    public function user(){
        return $this->belongsTo(User::class);
    }

    //问题--评论
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    public function scopePublished($query)
    {
        return $query->where('is_hidden','F');
    }
}