<?php

namespace App\Http\Controllers;

use App\Services\UploadService;

class UserController extends Controller
{
    public function setting()
    {
        return view('user.setting');
    }

    public function avatar(UploadService $service)
    {
        $size = request()->file('upload_file')->getSize() / 1024 / 1024;
        if ($size > 2) {
            return response()->json(['success' => false, 'msg' => '图片不得超过2MB']);
        }

        $filePath = $service->avatar(request()->file());

        $res = me()->update(['avatar' => $filePath]);

        return response()->json(['success' => true, 'msg' => '成功', 'file_path' => $filePath]);
    }

    public function friends()
    {
        $friends = me()->friends()->orderByDesc('friend_id')->paginate(10);

        return view('user.friends', compact('friends'));
    }
}
