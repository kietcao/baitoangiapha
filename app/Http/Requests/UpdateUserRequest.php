<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:200'],
            'address' => ['nullable', 'string', 'max:200'],
            'avatar' => ['nullable', 'mimes:jpeg,png,jpg', 'max:10000'], // 10mb
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền :attribute',
            'name.string' => ':Attribute là kiểu chuỗi ký tự',
            'name.max' => ':Attribute tối đa :max ký tự',

            'address.string' => ':Attribute là kiểu chuỗi ký tự',
            'address.max' => ':Attribute tối đa :max ký tự',

            'avatar.mimes' => ':Attribute định dạng jpeg,png,jpg',
            'avatar.max' => ':Attribute tối đa 10MB',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'họ tên',
            'address' => 'địa chỉ',
            'avatar' => 'ảnh đại diện',
        ];
    }
}
