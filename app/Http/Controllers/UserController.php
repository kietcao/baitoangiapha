<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Constants\UserType;
use App\Http\Requests\AdminRegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Constants\EnableStatus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\RegisterUserRequest;

class UserController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $users = User::where('id', '<>', Auth::user()->id)->get();
        return view('admin.user_manager', [
            'users' => $users,
            'current_page' => CurrentPage::USER,
        ]);
    }

    public function updateIsEnable(Request $request)
    {
        $user = User::find($request->id);
        $user->enable_status = $request->enable_status;
        return $user->save();
    }

    public function adminUserRegisterView()
    {
        return view('admin.admin_user_register', [
            'current_page' => CurrentPage::USER,
        ]);
    }

    public function adminUserRegister(AdminRegisterUserRequest $request)
    {
        $user = new User;
        $user->user_type = $request->user_type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->cccd_number = $request->cccd_number;
        $user->enable_status = EnableStatus::UNACTIVE;
        $user->password = Hash::make(Str::random(8));
        if ($request->has('avatar')) {
            $avatar = $this->storePublicImage($request->file('avatar'), 'img/members');
            $user->avatar = $avatar;
        }
        if ($request->has('cccd_image_before') && $request->has('cccd_image_after')) {
            $cccdImageBefore = $this->storeCCCD($request->file('cccd_image_before'));
            $user->cccd_image_before = $cccdImageBefore;
            $cccdImageAfter = $this->storeCCCD($request->file('cccd_image_after'));
            $user->cccd_image_after = $cccdImageAfter;
        }
        $user->save();

        // Create token and send invite
        $token = Password::createToken($user);
        $token = Crypt::encrypt([
            'token' => $token,
            'email' => $request->email,
        ]);
        Mail::send('mail.invite-user', ['token' => $token], function ($message) use($request, $token) {
            $message->to($request->email, $request->name);
            $message->subject('Thư mời tham gia');
        });

        return redirect()->route('users');
    }

    public function deleteUser()
    {

    }

    public function getCCCDImage($imagePath)
    {
        return $this->getCCCD($imagePath);
    }

    public function registerView()
    {
        return view('global.user_register');
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $user = new User;
        if ($request->has('avatar')) {
            $avatar = $this->storePublicImage($request->file('avatar'), 'img/members');
            $user->avatar = $avatar;
        }
        if ($request->has('cccd_image_before') && $request->has('cccd_image_after')) {
            $cccdImageBefore = $this->storeCCCD($request->file('cccd_image_before'));
            $user->cccd_image_before = $cccdImageBefore;
            $cccdImageAfter = $this->storeCCCD($request->file('cccd_image_after'));
            $user->cccd_image_after = $cccdImageAfter;
        }
        $user->user_type = UserType::USER;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->cccd_number = $request->cccd_number;
        $user->enable_status = EnableStatus::DISABLE;
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::send('mail.request-join', ['user' => $user], function ($message) {
            $message->to(env('ADMIN_EMAIL'));
            $message->subject('YÊU CẦU THAM GIA');
        });
        
        return view('global.messages_auth_view');
    }
}
