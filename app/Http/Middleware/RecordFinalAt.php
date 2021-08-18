<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class RecordFinalAt
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            Cache::remember('record_final_at_' . $user->getKey(), 60, function () use ($user) {
                $user->timestamps = false;
                $user->final_at   = now();
                $user->final_ip   = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
                $user->save();
                return true;
            });
        }

        return $next($request);
    }
}
