<?php

namespace App\Admin\Actions\User;

use Encore\Admin\Actions\RowAction;

class CoinLog extends RowAction
{
    public $name = '金币记录';

    public function href()
    {
        return route(admin_get_route('coin-logs.index'), ['user_id' => $this->getKey()]);
    }

}
