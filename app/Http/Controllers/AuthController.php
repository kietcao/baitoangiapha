<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('global.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Sai tên đăng nhập hoặc mật khẩu !']);
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login_view');
    }
}
