<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($msg = null, $data = [])
    {
        return response()->json(['code' => 200, 'msg' => $msg ?? '成功', 'data' => $data]);
    }

    public function error($msg = null, $data = [])
    {
        return response()->json(['code' => 400, 'msg' => $msg ?? '失败', 'data' => $data]);
    }

    public function me()
    {
        return auth()->user();
    }
}
