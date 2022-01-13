<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIsAdmin
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
        $user = Auth::user();
        if ($user->is_admin) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
