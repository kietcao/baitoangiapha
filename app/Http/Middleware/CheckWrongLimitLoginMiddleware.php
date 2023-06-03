<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckWrongLimitLoginMiddleware
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
        $key = Str::lower($request->email.$request->ip());
        $maxAttempts = env('MAX_ATTEMP_LOGIN', 10);
        $decaySeconds = env('DECAY_SECOND',  86400);
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $waitingTime = RateLimiter::availableIn($key);
            $hours = intdiv($waitingTime, 3600);
            $minutes = intdiv($waitingTime % 3600, 60);
            $seconds = $waitingTime % 60;
            return redirect()->back()->withErrors(['message' => "Đăng nhập sau $hours:$minutes:$seconds nữa."]);
        } else {
            RateLimiter::hit($key, $decaySeconds);
            return $next($request);
        }
    }
}
