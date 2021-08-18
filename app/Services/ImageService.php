<?php

namespace App\Services;


use Illuminate\Support\Facades\Log;

class ImageService
{
    /**
     * @param $remoteImage
     * @param $saveFile
     * apt-get install php-imagick
     * @return mixed
     * @throws \ImagickException
     */
    public function makeWaterMark($remoteImage, $saveFile)
    {
//        $image = new \Imagick($remoteImage);
//        $image = $image->coalesceImages();
//
//        $watermark = new \Imagick(public_path('img/watermark.png'));
//
//        $watermark->thumbnailImage(100, 0);
//
//        $x = $image->getImageWidth() - $watermark->getImageWidth() - 10;
//        $y = $image->getImageHeight() - $watermark->getImageHeight() - 10;
//
//        foreach ($image as $index => $frame) {
//            $res = $frame->compositeImage($watermark, \Imagick::COMPOSITE_DEFAULT, $x, $y);
//            if ($res) {
//                Log::info('make_watermark:[' . $index . '][' . $remoteImage . ']');
//            }
//        }
//        Log::info('make_watermark:[start][optimizeImageLayers]');
//        $image->optimizeImageLayers();
//        Log::info('make_watermark:[optimizeImageLayers]');
//        $image->writeImages($saveFile, true);
//        Log::info('make_watermark1:[writeImages]');
        $animation = $remoteImage;

        $watermark = public_path('img/watermark_100.png');///var/www/daz3d/public/img/watermark_100.png

        $watermarked_animation = $saveFile;//"/home/vagrant/code/daz3d/storage/app/public/images/2021/01/11/2.gif";

        $cmd = " $animation -coalesce -gravity SouthEast ".
            " -geometry +10+10 null: $watermark -layers composite -layers optimize ";
        exec("convert $cmd $watermarked_animation ");
        Log::info("convert $cmd $watermarked_animation ");
        return $saveFile;
    }
}