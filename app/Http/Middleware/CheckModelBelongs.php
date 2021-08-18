<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;

class CheckModelBelongs
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
        $model = collect($request->route()->parameters())->first();

        if ($model instanceof Model && $model->user_id !== $request->user()->getKey()) {
            return abort(403, __('Forbidden'));
        }

        return $next($request);
    }
}
