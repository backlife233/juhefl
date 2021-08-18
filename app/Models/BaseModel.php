<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use DefaultDatetimeFormat;

    protected $guarded = [];
}
