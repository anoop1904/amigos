<?php
namespace App\Http\Middleware;
use Closure;
class RedirectIfNotStudent
{
    
    public function handle($request, Closure $next, $guard="student")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect('/signin');
        }
        return $next($request);
    }
}