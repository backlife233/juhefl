<?php

namespace App\Jobs;

use App\Http\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WaterMark implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imageOriginal;
    public $imagePath;
    public $options;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imageOriginal, $imagePath, $options = [])
    {
        $this->imageOriginal = $imageOriginal;
        $this->imagePath     = $imagePath;
        $this->options       = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageService $service)
    {
        Log::info('watermark start:' . $this->imageOriginal);
        try {
            $service->makeWaterMark($this->imageOriginal, $this->imagePath, $this->options);
        } catch (\Exception $e) {
            Log::info('watermark_error:' . $e);
        }
    }
}
