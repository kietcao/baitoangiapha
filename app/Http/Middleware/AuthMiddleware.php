<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constants\EnableStatus;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            if (Auth::user()->enable_status == EnableStatus::DISABLE) {
                Auth::logout();
                abort(403, 'Bị vô hiệu hoá hoặc chưa có quyền truy cập');
            }
            else if (Auth::user()->enable_status == EnableStatus::UNACTIVE) {
                abort(403, 'Reset password');
            }
            return $next($request);
        }
        return redirect()->route('login_view');
    }
}
