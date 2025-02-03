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
        if (!Auth::guard('admin')->check()) {
            $admin = Admin::where('email', $request->email)->first();
            if (!$admin) {
                return redirect()->route('login')->with('error', 'Email not found');
            }
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->put('admin', Auth::guard('admin')->user());
                $request->session()->put('admin_id', Auth::guard('admin')->id());
                return $next($request);
            }
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
        return $next($request);
    }
}
