<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;

class QuestionsController extends Controller
{
    protected  $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index','show']);

        $this->questionRepository = $questionRepository;
    }


    //获得所有帖子
    public function index(){
        $questions = $this->questionRepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }

    //跳转到帖子创建的视图
    public function create(){
        return view('questions.create');
    }

    //添加帖子
    public function store(StoreQuestionRequest $request){
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
        ];
        $quretion = $this->questionRepository->create($data);
        Auth::user()->increment('questions_count');
        return redirect()->route('questions.show',[$quretion->id]);
    }

    //显示界面
    public function show($id){
        $question = $this->questionRepository->byIdWithAnswers($id);
        return view('questions.show',compact('question'));
        return $question;
    }

    //删除帖子
    public function destroy($id){
        $question = $this->questionRepository->byId($id);
        if(Auth::user()->owns($question)){
            $question->delete();
            Auth::user()->decrement('questions_count');
            return redirect('/');
        }
        abort(403,'Forbidden');
    }

    //编辑帖子
    public function edit($id){
        $question = $this->questionRepository->byId($id);
        if(Auth::user()->owns($question)){
            return view('questions.edit',compact('question'));
        }
    }

    //更新
    public function update(StoreQuestionRequest $request,$id){
        $question=$this->questionRepository->byId($id);
        $question->update([
           'title'=>$request->get('title'),
            'body'=>$request->get('body')
        ]);

        return redirect()->route('questions.show',[$question->id]);
    }
}
