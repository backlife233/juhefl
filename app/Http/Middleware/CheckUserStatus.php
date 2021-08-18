<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    /**
     * @param         $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && me()->user_status === 0) {
            return abort(403, '账户已禁用');
        }

        return $next($request);
    }
}
