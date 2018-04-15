<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/14
 * Time: 0:09
 */

namespace App\Repositories;

use App\Answer;

class AnswerRepository
{
    public function create(array $attributes){
        return Answer::create($attributes);
    }

    //指定id获取
    public function byId($id){
        return Answer::find($id);
    }

    //获取答案的所有评论
    public function getAnswerCommentsById($id){
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();

        return $answer->comments;
    }

    //增加评论数
    public function addCommentsCount($id){
        $answer = Answer::find($id);
        $answer->increment('comments_count');
    }
}