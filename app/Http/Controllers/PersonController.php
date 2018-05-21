<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;

class PersonController extends Controller
{
    //个人主页
    public function index($username){
        $user = User::Where('name',$username)->first();
        $questions = $user->questions;
        return view('person.questions',compact('user','questions'));
    }

    public function answer($userName){
        $user = User::where('name',$userName)->first();
        $answerId = $user->answers->unique('question_id')->pluck('question_id');
        $questions = Question::find($answerId->toArray());
        return view('person.answers',compact(['user','questions']));
    }

    public function personConcern($userName){
        $user = User::where('name',$userName)->first();
        $questionId = $user->follow()->pluck('question_id');
        $questions = Question::find($questionId->toArray());
        return view('person.concern',compact(['user','questions']));
    }
}
