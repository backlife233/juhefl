<?php

namespace App\Providers;

use App\Models\Friend;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class NavServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['*'], function ($view) {
            $view->with('navs', [
                ['name' => '首页', 'link' => '/'],
            ]);
        });

        view()->composer(['parts.sidebar'], function ($view) {
            $view->with('hot_posts', Cache::remember('hot_posts1', 60, function () {
                return Post::take(10)->orderByDesc('sort')->orderByDesc('post_id')->get();
            }));
        });
    }
}
