<?php

namespace App\Observers;

use Encore\Admin\Config\ConfigModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class ConfigModelObserver
{
    private function deleteCache()
    {
        Cache::forget('config-cache');
        Artisan::call('queue:restart');
    }

    /**
     * @param ConfigModel $configModel
     */
    public function created(ConfigModel $configModel)
    {
        $this->deleteCache();
    }

    /**
     * Handle the config model "updated" event.
     *
     * @param  ConfigModel $configModel
     * @return void
     */
    public function updated(ConfigModel $configModel)
    {
        $this->deleteCache();
    }

    /**
     * Handle the config model "deleted" event.
     *
     * @param  ConfigModel $configModel
     * @return void
     */
    public function deleted(ConfigModel $configModel)
    {
        $this->deleteCache();
    }
}
