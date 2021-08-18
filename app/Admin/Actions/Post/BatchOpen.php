<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BatchOpen extends BatchAction
{
    public $name = '修改状态';

    public function handle(Collection $collection)
    {
        $status = request()->input('status');
        foreach ($collection as $model) {
            $model->post_status = $status;
            // 暂时
            $model->content     = $model->content;
            $model->save();
        }

        return $this->response()->success('更新成功');
    }

    public function form()
    {
        $this->radio('status', '状态')->default(1)->options([0 => '关闭', 1 => '开启']);
    }

}
