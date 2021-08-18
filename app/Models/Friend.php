<?php

namespace App\Models;

class Friend extends BaseModel
{
    protected $primaryKey = 'friend_id';

    const CATEGORY = [
        '精品推荐' => '精品推荐',
        '在线视频' => '在线视频',
        '综合福利' => '综合福利',
        '美图套图' => '美图套图',
        '漫画动漫' => '漫画动漫',
        '视讯秀场' => '视讯秀场',
        '福利导航' => '福利导航',
        '在线工具' => '在线工具',
        '科学上网' => '科学上网',
    ];

    const STATUS_STR = [
        0 => '待检测',
        1 => '正常',
        2 => '未检测到',
    ];

    public function getStatusStrAttribute()
    {
        return self::STATUS_STR[$this->status] ?? '未知';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
