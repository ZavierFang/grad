<?php
/**
 * Created by PhpStorm.
 * User: Fang
 * Date: 2018/4/6
 * Time: 16:04
 */

namespace App\Repositories;

use App\Question;

class QuestionRepository
{
    //拿到问题的答案
    public function byIdWithAnswers($id){
        return Question::where('id', $id)->with(['answers'])->first();
    }

    //拿到所有问题
    public function getQuestionsFeed(){
        return Question::published()->orderBy('is_first','desc')->latest('updated_at')->with('user')->get();
    }

    //指定问题的评论
    public function getQuestionCommentsById($id){
        $question = Question::with('comments', 'comments.user')->where('id', $id)->first();

        return $question->comments;
    }

    //增问题的评论数
    public function addCommentsCount($id)
    {
        $question = Question::find($id);
        $question->increment('comments_count');
    }

    //创建问题
    public function create(array $attributes){
        return Question::create($attributes);
    }

    //获得指定id的帖子
    public function byId($id){
        return Question::find($id);
    }

}