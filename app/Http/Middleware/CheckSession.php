<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// class CheckSession
class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('obj'))
            $session_email = $request->session()->get('obj');
        else
            return redirect('session/new');

        return $next($request);
    }
}
