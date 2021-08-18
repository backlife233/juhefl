<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, DefaultDatetimeFormat;

    protected $guarded = [];

    public $appends = [
        'is_vip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'my_text'           => 'array',
        'referers'          => 'array',
    ];

    protected $dates = [
        'vip_at'
    ];

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function getIsVipAttribute()
    {
        return false;//$this->vip_at >= now();
    }
}
