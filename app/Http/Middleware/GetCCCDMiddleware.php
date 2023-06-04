<?php

namespace App\Http\Middleware;

use App\Constants\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GetCCCDMiddleware
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
        // Admin or own user view cccd image
        if (Auth::check()) {
            $user = Auth::user();
            $imagePath = request('image_path');
            $userOwnCCCD = User::where('cccd_image_before', $imagePath)->orWhere('cccd_image_after', $imagePath)->first();
            if ($user->user_type == UserType::ADMIN || $userOwnCCCD->id == $user->id) {
                return $next($request);
            }
        }

        return redirect()->route('login_view'); 
    }
}
