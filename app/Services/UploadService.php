<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2020/5/26
 * Time: 17:51
 */

namespace App\Services;

use App\Jobs\WaterMark;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadService
{
    /**
     * @param $files
     * @return array
     * @throws \ImagickException
     */
    public function upload($files, $options = [])
    {
        $urls = [];

        $extra = request('ext', 'posts');
        if (in_array($extra, ['comment', 'posts'])) {
            $extra .= '/';
        }

        $saveDir = 'images/' . $extra . date('Y/m/d/');

        if (!Storage::disk('public')->exists($saveDir)) {
            Storage::disk('public')->makeDirectory($saveDir);
        };

        foreach ($files as $file) {
            if ($file->getClientMimeType() === 'image/gif') {
                $path = Storage::disk('public')->putFile($saveDir, $file);

                if (!in_array('no_make_gif_watermark', $options)) {
                    $realPath = Storage::disk('public')->path($path);
                    dispatch(new WaterMark($realPath, $realPath, ['watermark']));
                }

            } else {
                $path = $this->makeWaterMark($file, $saveDir . $file->hashName());
            }

            if ($path === false) {
                continue;
            }
            // 给PostObserver用
            Cache::put('filename_path_' . $path, $file->getClientOriginalName(), 3600);

            $path = str_replace('//', '/', $path);

            $urls[] = Storage::disk('public')->url($path);
        }
        return $urls;
    }

    public function avatar($files)
    {
        $saveDir = 'images/avatar/' . date('Y/m/d');

        if (!Storage::disk('public')->exists($saveDir)) {
            Storage::disk('public')->makeDirectory($saveDir);
        }
        $file = $files['upload_file'];

        $image = Image::make($file);

        $relativePath = $saveDir . '/user_' . me()->getKey() . '_' . $file->hashName();
        $format       = pathinfo($relativePath, PATHINFO_EXTENSION);
        $relativePath = str_replace('.' . $format, '.jpg', $relativePath);
        $filePath     = Storage::disk('public')->path($relativePath);

        $image->fit(120)->save($filePath, 90, 'jpg');

        return $relativePath;
    }

    public function makeWaterMark($file, $savePath = null)
    {

        $image     = Image::make($file);
        $directory = storage_path('app/public');

        $width = $image->getWidth();

        $watermark = Image::make(public_path('assets/images/watermark.png'))->opacity(68)->widen((int)($width * 0.3));

        $path = '/images/' . $file->hashName();
        if ($savePath) {
            $path = Str::start($savePath, '/');
        }

        $image->insert($watermark, 'right-bottom', 30, 30)->save($directory . $path);

        return $path;
    }

    public function makeSmall($path, $width = 750)
    {
        $returnPath = $path;
        $path       = Storage::path(Str::start($path, 'public/'));

        $suffix  = '-' . $width;
        $newPath = str_replace('.', $suffix . '.', $path);

        if (preg_match('#-\d+\.#', $path)) {
            return false;
        }

        try {
            $img = Image::make($path);
        } catch (\Exception $e) {
            Log::info('make-fail:' . $e->getMessage());
            return false;
        }
        $percent = 100 * 1024 / $img->filesize();

        if ($percent >= 1) {
            return $returnPath;
        }
        $info = pathinfo($newPath);

        $newPath = $info['dirname'] . '/' . $info['filename'] . '.jpg';

        $img->widen($width)->save($newPath, 80, 'jpg');

        $newPath = str_replace(config('filesystems.disks.public.root') . '/', '', $newPath);

        return $newPath;
    }
}
