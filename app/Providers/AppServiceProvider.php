<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Observers\ConfigModelObserver;
use App\Observers\PostObserver;
use Encore\Admin\Config\ConfigModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

//        if (!app()->runningInConsole()) {
//            $configs = ConfigModel::all(['name', 'value']);
        $configs = Cache::rememberForever('config-cache', function () {
            return ConfigModel::all(['name', 'value']);
        });
        foreach ($configs as $config) {
            config([$config['name'] => $config['value']]);
        }

        Post::observe(PostObserver::class);
        ConfigModel::observe(ConfigModelObserver::class);
    }
}
