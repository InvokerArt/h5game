<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use URL;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            if (!URL::isValidUrl(env('APP_URL').DS.env('APP_BACKEND_PREFIX').'/login') || !URL::isValidUrl(env('APP_URL').DS.'/login')) {
                Session::put('url.intended', URL::full());
            }
        } else {
            if (str_replace('/', '', request()->route()->getPrefix()) == env('APP_BACKEND_PREFIX')) {
                return redirect(env('APP_BACKEND_PREFIX').DS.'dashboard');
            } else {
                return redirect('dashboard');
            }
        }
        return $next($request);
    }
}
