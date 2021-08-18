<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class ImageService
{
    /**
     * @param $remoteImage
     * @param $saveFile
     * @param array $options ['watermark', 'jpg_preview', 'gif_preview']
     * @return mixed
     * @throws \ImagickException
     */
    public function makeWaterMark($remoteImage, $saveFile, $options = [])
    {
        $doWaterMark  = in_array('watermark', $options);
        $doJpgPreview = in_array('jpg_preview', $options);
        $doGifPreview = in_array('gif_preview', $options);

        $remoteImage = str_replace('//', '/', $remoteImage);
        $saveFile    = str_replace('//', '/', $saveFile);

        $image = new \Imagick($remoteImage);
        $image = $image->coalesceImages();
//        $totalFrames = $image->getNumberImages();
//        $tick        = $image->getImageTicksPerSecond();

        if ($doWaterMark) {
            $watermark = new \Imagick(public_path('assets/images/watermark.png'));
            $watermark->thumbnailImage(max($image->getImageWidth() * 0.15,75), 0);
            $watermark->evaluateImage(\Imagick::EVALUATE_DIVIDE, 1.5, \Imagick::CHANNEL_ALPHA);
            $x = $image->getImageWidth() - $watermark->getImageWidth() - 10;
            $y = $image->getImageHeight() - $watermark->getImageHeight() - 10;
        }


        $previewGif = new \Imagick();

        foreach ($image as $key => $frame) {

            if ($doWaterMark) {
                $frame->compositeImage($watermark, \Imagick::COMPOSITE_DEFAULT, $x, $y);
            }

            // 存jpg预览
            if ($doJpgPreview) {
                if ($key === 0) {
                    $previewFile = str_replace('.gif', '_preview.jpg', $saveFile);
                    $frame->writeImage($previewFile);
                    Log::info('jpg preview finish:' . $previewFile);
                }
            }

            // 存gif预览
            if ($doGifPreview) {
                $pre     = 5;
                $percent = 1 / $pre;
                if ($key % $pre === 0) {
                    $previewGif->addImage($frame->getImage());
                    $previewGif->setImageTicksPerSecond(100 * $percent);
                }
            }

            unset($frame);
        }

        if ($doWaterMark) {
            $image = $image->optimizeImageLayers();
            $image->writeImages($saveFile, true);
            Log::info('watermark finish:' . $saveFile);
        }

        if ($doGifPreview) {
            $previewGif = $previewGif->optimizeImageLayers();
            $previewGif->writeImages(str_replace('.gif', '_preview.gif', $saveFile), true);
            Log::info('gif preview finish:' . $saveFile);
        }

        unset($image);

        if ($doGifPreview) {
            unset($previewGif);
        }

        if ($doWaterMark) {
            unset($watermark);
        }

        return $saveFile;
    }
}
