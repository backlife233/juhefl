<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use QL\QueryList;

class ReCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $friend;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($friend)
    {
        $this->friend = $friend;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('re-check start');

        $friend = $this->friend;

        $ql = QueryList::getInstance();

        $ourDomain = ['888.showtime.test'];

        // 隐藏的怎么检测，一般不会
        $hrefs = $ql->get($friend->link)->find('a')->attrs('href')->map(function ($item) {
            return parse_url($item)['host'] ?? null;
        })->filter()->intersect($ourDomain);

        $friend->update(['status' => $hrefs->count() > 0 ? 1 : 2]);
    }
}
