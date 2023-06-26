<?php

namespace App\Http\Requests;

use App\Models\FamilyMember;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilyMemberRequest extends FormRequest
{
    public function rules()
    {
        $member = FamilyMember::find(request()->id);
        $rules = [
            'fullname' => ['required', 'max:200', 'string'],
            'role_name' => ['required', 'max:200', 'string'],
            'avatar' => ['nullable', 'mimes:jpeg,png,jpg', 'max:10000'], // 10mb
            'cccd_number' => ['required', 'digits_between:10,50', 'numeric'],
            'cccd_image_before' =>  ['nullable', 'mimes:jpeg,png,jpg', 'max:10000'],
            'cccd_image_after' =>  ['nullable', 'mimes:jpeg,png,jpg', 'max:10000'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'leaveday' => ['nullable', 'date_format:Y-m-d'],
            'address' => ['nullable', 'max:200', 'string'],
            'email' => ['nullable', 'email', 'max:200'],
            'phone' => ['nullable', 'digits_between:8,13'],
            'story' => ['nullable', 'string'],
        ];

        if (!empty($member->position_index)) {
            $rules['position_index'] = ['numeric', 'min:1', 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng điền :attribute',
            'fullname.max' => ':Attribute tối đa :max ký tự',
            'fullname.string' => ':Attribute dạng chuỗi ký tự',

            'role_name.required' => 'Vui lòng điền :attribute',
            'role_name.max' => ':Attribute tối đa :max ký tự',
            'role_name.string' => ':Attribute dạng chuỗi ký tự',

            'avatar.mimes' => ':Attribute có định dạng jpeg, png, jpg',
            'avatar.max' => ':Attribute không quá 10MB',
            
            'cccd_number.required' => 'Vui lòng điền :attribute',
            'cccd_number.digits_between' => ':Attribute tối đa 10-50 ký tự',
            'cccd_number.numeric' => ':Attribute là kiểu số',

            'cccd_image_before.mimes' => ':Attribute định dạng jpeg,png,jpg',
            'cccd_image_before.max' => ':Attribute tối đa 10MB',

            'cccd_image_after.mimes' => ':Attribute định dạng jpeg,png,jpg',
            'cccd_image_after.max' => ':Attribute tối đa 10MB',

            'birthday.required' => 'Vui lòng điền :attribute',
            'birthday.date_format' => ':Attribute có định dạng yyyy-mm-dd',

            'leaveday.date_format' => ':Attribute có định dạng yyyy-mm-dd',

            'address.string' => ':Attribute dạng chuỗi ký tự',
            'address.max' => ':Attribute tối đa :max ký tự',

            'email.email' => ':Attribute sai định dạng',
            'email.max' => ':Attribute tối đa :max ký tự',

            'phone.digits_between' => ':Attribute từ [8~13] ký tự',

            'gender.required' => 'Vui lòng điền :attribute',
            'gender.digits_between' => ':Attribute trong phạm vi [:digits_between]',

            'story.string' => ':Attribute dạng chuỗi ký tự',

            'position_index.required' => 'Vui lòng điền :attribute',
            'position_index.numeric' => ':Attribute phải là dạng số',
            'position_index.min' => ':Attribute tối thiểu là :min',
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'họ tên',
            'role_name' => 'vai trò',
            'avatar' => 'ảnh đại diện',
            'birthday' => 'ngày sinh',
            'leaveday' => 'ngày mất',
            'address' => 'địa chỉ',
            'email' => 'email',
            'phone' => 'số điện thoại',
            'gender' => 'giới tính',
            'story' => 'tiểu sử',
            'position_index' => 'vị trí con cái',
            'cccd_number' => 'mã cccd',
            'cccd_image_before' => 'ảnh mặt trước cccd',
            'cccd_image_after' => 'ảnh mặt sau cccd',
        ];
    }
}
