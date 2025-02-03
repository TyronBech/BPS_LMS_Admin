<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check() && !$this->isLogoutRequest($request)) {
            if ($request->expectsJson()) {
                return response('Unauthorized.', 401);
            }
            return redirect()->route('login')->with('toast-error', 'Session expired or unauthorized. Please log in.');
        }
        return $next($request);
    }

    protected function isLogoutRequest(Request $request) {
        return $request->isMethod('post') && $request->routeIs('admin.logout');
    }
}
