<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as'         => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('posts', PostController::class);

    $router->post('upload', 'PostController@upload')->name('upload');

    $router->resource('users', UserController::class);

    $router->resource('friends', FriendController::class);

    $router->resource('referer-logs', RefererLogController::class);
});
