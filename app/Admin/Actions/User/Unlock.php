<?php

namespace App\Admin\Actions\User;

use Encore\Admin\Actions\RowAction;

class Unlock extends RowAction
{
    public $name = '解锁';

    public function href()
    {
        return route(admin_get_route('unlocks.index'), ['user_id' => $this->getKey()]);
    }

}
