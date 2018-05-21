<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use Auth;

class QuestionFollowController extends Controller
{
    protected $question;

    public function __construct(QuestionRepository $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }

    public function follow($questionId)
    {
        Auth::user()->followQuestion($questionId);
        $question = $this->question->byId($questionId);
        $question->increment('followers_count');
        return back();
    }

}
