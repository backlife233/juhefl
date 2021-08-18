<?php

namespace App\Admin\Actions\Post;

use App\Jobs\WaterMark;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class BatchPreview extends BatchAction
{
    public $name = '水印预览生成';

    public function handle(Collection $collection)
    {
        $options = request('options');

        foreach ($collection as $model) {
            $path = Storage::disk('public')->path($model->cover);
            $model->update(['updated_at' => now()]);
            dispatch(new WaterMark($path, $path, $options));
        }

        return $this->response()->success('开始生成');
    }

    public function form()
    {
        $this->checkbox('options', '生成')->default('jpg_preview')->options(['watermark' => '水印', 'jpg_preview' => 'JPG预览', 'gif_preview' => 'GIF预览']);
    }

}
