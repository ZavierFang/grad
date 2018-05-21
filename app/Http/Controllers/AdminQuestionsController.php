<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Controller;

class AdminQuestionsController extends Controller
{
    private $question;
    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    //管理员内容管理--问题管理
    public function index(){
        $questions = $this->question->getQuestionsFeed();
        return view('admin.questions.index',compact('questions'));
    }

    //管理员内容管理--问题删除
    public function delete($id){
        $question = $this->question->byId($id);
        $question->delete();
        return redirect()->route('admin.questions');
    }
}
