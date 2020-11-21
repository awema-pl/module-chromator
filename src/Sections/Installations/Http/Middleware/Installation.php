<?php

namespace AwemaPL\Chromator\Sections\Installations\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use AwemaPL\Chromator\Facades\Chromator;

class Installation
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Chromator::canInstallation()){
            $route = Route::getRoutes()->match($request);
            $name = $route->getName();
            if (!in_array($name, config('chromator.routes.installation.expect'))){
                return redirect()->route('chromator.installation.index');
            }
        }
        return $next($request);
    }
}
