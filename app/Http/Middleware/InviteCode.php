<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class InviteCode
{
    /**
     * @param         $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $code = request()->input('aff', null);

        if (is_null($code)) {
            return $next($request);
        }

        Cookie::queue('aff', $code, 60 * 24 * 7);

        return $next($request);
    }
}
