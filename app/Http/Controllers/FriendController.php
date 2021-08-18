<?php

namespace App\Http\Controllers;

use App\Jobs\ReCheck;
use App\Models\Friend;

class FriendController extends Controller
{
    public function jump(Friend $friend)
    {
        $friend->increment('out');

        return view('friend.jump', compact('friend'));
    }

    public function reCheck(Friend $friend)
    {
        dispatch_now(new ReCheck($friend));
        return $this->success('开始检测，一分钟后刷新该页面...');
    }

    public function create()
    {
        $isEdit = 0;

        $categories = Friend::CATEGORY;

        return view('friend.create', compact('isEdit', 'categories'));
    }

    public function edit(Friend $friend)
    {
        $isEdit = 1;

        $categories = Friend::CATEGORY;

        return view('friend.create', compact('isEdit', 'categories', 'friend'));
    }

    protected function dataValidate()
    {
        return request()->validate([
            'name'     => ['required', 'string', 'max:10'],
            'link'     => ['required', 'string'],
            'category' => ['required', 'string'],
        ], [], [
            'name'     => '网站名称',
            'link'     => '网站链接',
            'category' => '分类'
        ]);
    }

    public function store()
    {
        $data = $this->dataValidate();

        if (!in_array($data['category'], Friend::CATEGORY)) {
            return $this->error('提交失败，非法分类');
        }

        $data['user_id'] = me()->getKey();

        Friend::create($data);

        return $this->success('提交成功，等待检测', ['url' => route('user.friends')]);
    }

    public function update(Friend $friend)
    {
        $data = $this->dataValidate();

        if (!in_array($data['category'], Friend::CATEGORY)) {
            return $this->error('提交失败，非法分类');
        }

        $data['user_id'] = me()->getKey();

        $friend->update($data);

        return $this->success('提交成功，等待检测', ['url' => route('user.friends')]);
    }
}
