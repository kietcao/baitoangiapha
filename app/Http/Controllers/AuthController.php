<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Constants\EnableStatus;
use App\Constants\UserType;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ConfirmResetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageTrait;

class AuthController extends Controller
{
    use ImageTrait;

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

    public function mypageView()
    {
        $user = Auth::user();
        return view('global.mypage', [
            'user' => $user,
            'current_page' => CurrentPage::MYPAGE,
        ]);
    }

    public function updateUserInfo(UpdateUserRequest $request)
    {
        $user = Auth::user();
        if ($request->has('avatar')) {
            $this->removeImage($user->avatar);
            $avatar = $this->storePublicImage($request->file('avatar'), 'img/members');
            $user->avatar = $avatar;
        }

        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();

        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message', 'Cập nhật mật khẩu thành công !');
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login_view');
    }
}
