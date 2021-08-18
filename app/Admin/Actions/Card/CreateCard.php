<?php

namespace App\Admin\Actions\Card;

use App\Models\Card;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class CreateCard extends Action
{
    protected $selector = '.create-card';

    public function handle(Request $request)
    {
        $num   = $request->input('num');
        $price = $request->input('price');

        Card::saveCard($num, $price);

        return $this->response()->success('生成成功')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default create-card">创建卡</a>
HTML;
    }

    public function form()
    {
        $this->integer('num', '数量')->default(20);
        $this->text('price', '价格')->default(20);
    }
}
