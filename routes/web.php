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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('tweet/save', 'PostController@store'); // 保存消息
Route::get('users/{user}', 'UserController@show')->name('user.show'); // 查看个人主页
Route::get('users/{user}/follow', 'UserController@follow')->name('user.follow'); // 关注用户