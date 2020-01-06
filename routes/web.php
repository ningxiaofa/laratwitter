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

Auth::routes(); // 详细: vendor\laravel\framework\src\Illuminate\Routing\Router.php
Route::get('/home', 'HomeController@index')->name('home');//个人主页
Route::get('users/{user}', 'UserController@show')->name('user.show'); // 查看用户个人主页
Route::middleware('auth')->group(function () {
    Route::post('tweet/save', 'PostController@store'); // 保存消息
    Route::get('users/{user}/follow', 'UserController@follow')->name('user.follow'); // 关注用户
    Route::get('users/{user}/unfollow', 'UserController@unfollow')->name('user.unfollow'); // 取消关注
    Route::get('posts', 'PostController@index')->name('posts.index'); // 获取到用户自己以及所关注用户的所有Tweet
});