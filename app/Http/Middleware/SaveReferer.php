<?php

namespace App\Http\Middleware;

use App\Models\Friend;
use App\Models\RefererLog;
use Closure;
use Illuminate\Support\Facades\Cookie;

class SaveReferer
{
    /**
     * @param         $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (strpos(url()->current(), admin_base_path())) {
            return $next($request);
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? null;

        if (is_null($referer)) {
            return $next($request);
        }

        $host   = parse_url($referer)['host'];
        $myHost = parse_url(config('app.url'))['host'];//www.xxx.com
        $myHost = str_replace('www.', '', $myHost);// 暂时
//todo www.xx.com xx.com
        if (strpos($host, $myHost) !== false) {
            return $next($request);
        }

        Cookie::queue('referer', $referer);

        RefererLog::create([
            'referer' => $referer,
            'domain'  => $host,
        ]);

        $friends = Friend::where('domain', $host)->get();

        foreach ($friends as $friend) {
            $friend->increment('come');
        }

        return $next($request);
    }
}
