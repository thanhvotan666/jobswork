<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            // Chuyển hướng dựa trên guard
            switch ($guard) {
                case 'admin':
                    return redirect()->route('admin.login')->with('error', 'Login to continue!');
                case 'employer':
                    return redirect()->route('employer.index')->with('error', 'Login to continue!');
                case 'user':
                    return redirect()->route('index')->with('error', 'Login to continue!');
                case 'api':
                    return response()->json(["errors" => ["Không tìm thấy người dùng"]]);
                default:
                    return redirect()->route('login')->with('error', 'Login to continue!'); // Guard mặc định
            }
        }

        return $next($request);
    }
}
