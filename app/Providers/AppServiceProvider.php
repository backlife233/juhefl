<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Friend;
use App\Observers\ConfigModelObserver;
use App\Observers\FriendObserver;
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

        ConfigModel::observe(ConfigModelObserver::class);
    }
}
