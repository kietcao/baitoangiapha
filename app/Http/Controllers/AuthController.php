<?php

namespace App\Http\Controllers;

use App\Constants\EnableStatus;
use App\Constants\UserType;
use App\Http\Requests\ConfirmResetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('global.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Sai tên đăng nhập hoặc mật khẩu !']);
    }

    public function resetPasswordView($token)
    {
        $decrypted = Crypt::decrypt($token);
        $user = User::where('email', $decrypted['email'])->firstOrFail();
        $existToken = Password::tokenExists($user, $decrypted['token']);
        
        if (!$existToken) {
            abort(403, 'Token hết hạn');
        }
        
        return view('global.reset_password', [
            'token_reset' => $token
        ]);
    }

    public function confirmResetPassword(ConfirmResetPasswordRequest $request)
    {
        $decrypted = Crypt::decrypt($request->token_reset);
        $user = User::where('email', $decrypted['email'])->firstOrFail();
        $existToken = Password::tokenExists($user, $decrypted['token']);

        if (!$existToken) {
            abort(403, 'Token hết hạn');
        }

        Password::deleteToken($user);
        $user->password = Hash::make($request->password);
        if ($user->enable_status == EnableStatus::UNACTIVE){
            $user->enable_status = EnableStatus::ENABLE;
        }
        $user->save();

        Auth::attempt([
            'email' => $decrypted['email'],
            'password' => $request->password
        ]);

        return redirect()->route('dashboard');
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login_view');
    }
}
