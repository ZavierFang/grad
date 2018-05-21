<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//restful资源控制
Route::resource('questions','QuestionsController',['names'=>[
    'create'=>'questions.create',
    'show'=>'questions.show'
]]);

Route::post('questions/{questionId}/answer','AnswersController@store');//写评论

Route::get('/questions/{questionId}/follow','QuestionFollowController@follow');//用户关注帖子

//更新资讯
Route::get('news/update','NewsController@store');
//资讯index
Route::get('news/index','NewsController@index')->name('news');


Route::get("/person/{username}",'PersonController@index')->name('questions');//个人主页index
Route::get("/person/{username}/answer",'PersonController@answer')->name('answer');//个人主页评论
Route::get("/person/{username}/concern",'PersonController@personConcern')->name('concern');//个人关注


Route::get("/setting",'SettingController@index');//个人设置
Route::post("/setting",'SettingController@store');//保存设置

//修改密码
Route::get("/password",'PasswordController@password');
Route::post("/password/update",'PasswordController@update');

//修改头像
Route::get("/setting/picture",'SettingController@change');

//管理员
Route::get('/admin', 'AdminController@index')->name('admin.index'); //后台首页
Route::get('/admin/questions/index','AdminQuestionsController@index')->name('admin.questions');//问题列表界面
Route::delete('/admin/question/{id}','AdminQuestionsController@delete');//删除问题
Route::get('/admin/users','AdminController@userIndex')->name('admin.users');//系统用户信息
Route::delete('admin/user/{id}','AdminController@destroy');