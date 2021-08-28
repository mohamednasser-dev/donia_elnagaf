<?php

namespace App\Http\Middleware;

use Closure;

class customer
{
    public function handle($request, Closure $next)
    {
        if (\Auth::guard('customer')->check()) {
            $request->id = \Auth::guard('customer')->user()->id;
            return $next($request);
        } else {
            return redirect()->back()->with('AuthLogin', 'error');
        }
    }
}
