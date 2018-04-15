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
