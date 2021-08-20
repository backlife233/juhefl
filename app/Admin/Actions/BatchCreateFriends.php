<?php

namespace App\Admin\Actions;

use App\Models\Friend;
use Encore\Admin\Actions\Action;

class BatchCreateFriends extends Action
{
    protected $selector = '.batch_create_friends';

    public function handle()
    {
        $data = request()->only(['content', 'category']);

        $items = preg_split('/\r\n/', $data['content']);
        foreach ($items as $item) {
            $item = explode(',', $item);

            if (!isset($item[0]) || !isset($item[1])) {
                return false;
            }

            $friend = ['name' => $item[0], 'link' => $item[1], 'category' => $data['category'], 'lock' => 1, 'status' => 1, 'domain' => ''];
            Friend::create($friend);
        }

        return $this->response()->success('更新成功')->refresh();
    }

    public function form()
    {
        $this->textarea('content', '内容');
        $this->select('category', '分类')->options(Friend::CATEGORY);
    }

    public function html()
    {
        return "<a class='batch_create_friends btn btn-sm btn-success'><i class='fa fa-info-circle'></i>批量添加</a>";
    }
}
