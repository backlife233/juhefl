<?php

use Illuminate\Support\Facades\Route;

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

Route::any('/', 'HomeController@index', ['get', 'post'])->name('index');

Route::get('osm', 'HomeController@openSafeMode');
Route::get('csm', 'HomeController@clearSafeMode');
Route::get('info', 'HomeController@info');


Route::get('jump/{friend}', 'FriendController@jump')->name('friend.jump');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'check_user_status']], function () {
    Route::post('upload', 'PostController@upload')->name('post.upload');


    Route::group(['prefix' => 'user'], function () {
        Route::get('setting', 'UserController@setting')->name('user.setting');
        Route::post('avatar', 'UserController@avatar')->name('user.avatar');

        Route::get('friends', 'UserController@friends')->name('user.friends');

        Route::get('friends/create', 'FriendController@create')->name('friend.create');
        Route::post('friends', 'FriendController@store')->name('friend.store');
        Route::get('friends/{friend}/edit', 'FriendController@edit')->name('friend.edit')->middleware(['check_model_belong']);
        Route::put('friends/{friend}', 'FriendController@update')->name('friend.update')->middleware(['check_model_belong']);

        Route::get('card', 'UserController@card')->name('user.card');

        Route::get('orders', 'UserController@orders')->name('user.orders');

        Route::post('card/use', 'UserController@cardUse')->name('user.card.use');
    });

    Route::post('friends/{friend}/re-check', 'FriendController@reCheck')->name('friends.re-check')->middleware(['check_model_belong']);
});

Route::get('posts/{post}', 'PostController@show')->name('posts.show');

Route::match(['get', 'post'], '/git/black_back', function () {

    $shell = ["/bin/bash", base_path('resources/shell/deploy.sh'), base_path()];

    $process = new \Symfony\Component\Process\Process($shell);
    $process->start();
    $process->wait(function ($type, $buffer) {
        if (\Symfony\Component\Process\Process::ERR === $type) {
            $str = 'ERR > ' . $buffer;
        } else {
            $str = 'OUT > ' . $buffer;
        }
        \Illuminate\Support\Facades\Log::info('command:' . $str);
        echo $str;
    });
});
