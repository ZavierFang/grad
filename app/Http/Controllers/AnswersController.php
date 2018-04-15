<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Auth;

class AnswersController extends Controller
{
    protected $answer;
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    //创建
    public function store(StoreAnswerRequest $request,$questionId){
        $answer = $this->answer->create([
            'question_id'=>$questionId,
            'user_id'=>Auth::id(),
            'body'=>$request->get('body')
        ]);
        $answer->question()->increment('answers_count');
        Auth::user()->increment('answers_count');
        return back();
    }
}
