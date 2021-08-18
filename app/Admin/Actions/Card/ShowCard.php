<?php

namespace App\Admin\Actions\Card;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class ShowCard extends BatchAction
{
    public $name = '显示';

    public function handle(Collection $collection)
    {
        $ids = '';
        foreach ($collection as $model) {
            $ids .= $model->getKey() . ',';
        }

        $ids = trim($ids, ',');

        return $this->response()->redirect(route(admin_get_route('cards_show'), ['ids' => $ids]));
    }

}
