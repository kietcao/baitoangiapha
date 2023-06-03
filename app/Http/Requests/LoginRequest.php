<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng điền :attribute',
            'email.email' => ':Attribute sai định dạng',
            'email.string' => 'Vui lòng cung cấp kiểu chuỗi',

            'password.required' => 'Vui lòng điền :attribute',
            'password.string' => 'Vui lòng cung cấp kiểu chuỗi',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email',
            'password' => 'mật khẩu',
        ];
    }
}
