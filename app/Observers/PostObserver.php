<?php

namespace App\Observers;

use App\Models\News;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use QL\QueryList;

class PostObserver
{
    public function saved(Post $post)
    {
        Log::info('post saved');

        $this->saveImages($post);
        $this->saveCategoryAlias($post);
    }

    private function saveImages(Post $post)
    {
        if (!$post->isDirty('content')) {
            //return false;
        }

        $ql = QueryList::getInstance();
        $ql->setHtml($post->content);

        $oldImages = collect($post->images);

        $images = $ql->find('img')->map(function ($item) use ($oldImages) {
            $src      = $item->src;
            $relative = str_replace('/storage/', '', parse_url($src)['path']);

            $oldFilename = $oldImages->where('src', $relative)->first()['filename'] ?? null;

            $filename = Cache::get('filename_path_' . $relative);
            return ['filename' => $filename ?? ($oldFilename ?? ''), 'src' => $relative];
        })->toArray();

        DB::table('posts')->where($post->getKeyName(), $post->getKey())->update(['images' => $images, 'cover' => $images[0]['src'] ?? null]);
    }

    private function saveCategoryAlias(Post $post)
    {
        if (!$post->isDirty('category_id')) {
            return false;
        }

        DB::table('posts')->where($post->getKeyName(), $post->getKey())->update(['category_alias' => $post->category->category_alias]);
    }
}
