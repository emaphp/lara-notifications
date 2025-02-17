<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->type != 'employee') {
            return redirect('home')->with('status','Access denied. Employee users only.');
        }
        return $next($request);
    }
}
