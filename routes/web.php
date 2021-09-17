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
Route::get('login/twitter', 'Auth\LoginController@redirectToProvider')->name('login.twitter');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'TeamsController@index');
Route::get('/enquete', 'EnquetesController@index');
Route::get('/question', 'QuestionsController@index');
Route::get('comment/{team_id}', 'CommentsController@index');
Route::post('teams', 'TeamsController@store');
Route::post('enquetes', 'EnquetesController@store');
Route::post('questions', 'QuestionsController@store');
Route::post('comment/{team_id}', 'CommentsController@store');
Route::get('team/{team_id}', 'TeamsController@join');
Route::get('enquete/{enquete_id}', 'EnquetesController@join');
Route::get('question/{question_id}', 'QuestionsController@join');
Route::get('comment/1/{comment_id}', 'CommentsController@join');
Route::get('teamedit/{team}', 'TeamsController@edit');
//チーム更新処理
Route::post('teams/update','TeamsController@update');
// チーム詳細表示
Route::get('teams/{team}','TeamsController@show');

