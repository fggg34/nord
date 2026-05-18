<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWhenFrontendUnderConstruction
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.frontend_under_construction', false)) {
            return $next($request);
        }

        if ($this->shouldBypass($request)) {
            return $next($request);
        }

        if ($request->isMethod('GET') && $request->path() !== '/') {
            return redirect()->to('/');
        }

        return $next($request);
    }

    protected function shouldBypass(Request $request): bool
    {
        if ($request->is('up')) {
            return true;
        }

        if ($request->is('login') || $request->is('logout')) {
            return true;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return true;
        }

        return false;
    }
}
