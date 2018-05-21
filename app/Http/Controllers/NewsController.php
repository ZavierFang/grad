<?php

namespace App\Http\Controllers;

use App\Repositories\NewRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Goutte\Client;

class NewsController extends Controller
{
    protected  $newsRepository;
    protected  $client;
    public function __construct(NewRepository $newRepository)
    {
        $this->newsRepository = $newRepository;
        $this->client = new Client();
    }


    //显示界面
    public function index(){
        $news = $this->newsRepository->getNewsFeed();
        return view('news.index',compact('news'));
    }

    //获得、更新资讯
    public function store(Request $request){
//        Schema::dropIfExists('news');
//        $shellData = shell_exec('php artisan migrate');
        $crawler = $this->client->request('GET','https://news.futunn.com/main');
        $crawler->filter('#news-list-container .news-li')->each(function ($node){
            $data=[
                'news_title'=>$node->filter('.news-title')->text(),
                'imgPath'=>$node->filter('.news-pic')->attr('src'),
                'news_url'=>$node->filter('.news-link')->attr('href'),
                'news_date'=>$node->filter('.news-time')->text()
            ];
            $this->newsRepository->create($data);
        });
        return redirect()->route('news');
    }
}
