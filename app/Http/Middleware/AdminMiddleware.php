<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if ($request->user() && $request->user()->role->name != 'admin')
        {
            return redirect()->route('admin_dashboard')->with('warning', 'You do not have permission to access this part!');
        }
        return $next($request);
    }
}
