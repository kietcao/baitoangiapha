<?php

namespace App\Http\Requests;

use App\Constants\Relation;
use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyMemberRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'relation' => ['required', 'digits_between:1,2'],
            'fullname' => ['required', 'max:200', 'string'],
            'role_name' => ['required', 'max:200', 'string'],
            'avatar' => ['required', 'mimes:jpeg,png,jpg', 'max:10000'], // 10mb
            'birthday' => ['required', 'date_format:Y-m-d'],
            'leaveday' => ['nullable', 'date_format:Y-m-d'],
            'address' => ['nullable', 'max:200', 'string'],
            'email' => ['nullable', 'email', 'max:200'],
            'phone' => ['nullable', 'digits_between:8,13'],
            'story' => ['nullable', 'string'],
            'mid' => ['nullable', 'numeric'],
            'fid' => ['nullable', 'numeric'],
        ];

        if (request()->relation == Relation::CHILD) {
            $rules['position_index'] = ['required', 'numeric', 'min:1'];
            $rules['gender'] = ['required', 'digits_between: 1,2'];
        } else if (request()->relation == Relation::COUPLE) {
            $rules['from_member_id'] = ['required', 'numeric'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'relation.required' => 'Vui lòng điền :attribute',
            'relation.digits_between' => ':Attribute từ :digits_between ký tự',
            
            'fullname.required' => 'Vui lòng điền :attribute',
            'fullname.max' => ':Attribute tối đa :max ký tự',
            'fullname.string' => ':Attribute dạng chuỗi ký tự',

            'role_name.required' => 'Vui lòng điền :attribute',
            'role_name.max' => ':Attribute tối đa :max ký tự',
            'role_name.string' => ':Attribute dạng chuỗi ký tự',

            'avatar.required' => 'Vui lòng chọn :attribute',
            'avatar.mimes' => ':Attribute có định dạng jpeg, png, jpg',
            'avatar.max' => ':Attribute không quá 10MB',

            'birthday.required' => 'Vui lòng điền :attribute',
            'birthday.date_format' => ':Attribute có định dạng yyyy-mm-dd',

            'leaveday.date_format' => ':Attribute có định dạng yyyy-mm-dd',

            'address.string' => ':Attribute dạng chuỗi ký tự',
            'address.max' => ':Attribute tối đa :max ký tự',

            'email.email' => ':Attribute sai định dạng',
            'email.max' => ':Attribute tối đa :max ký tự',

            'phone.digits_between' => ':Attribute từ :digits_between ký tự',

            'gender.required' => 'Vui lòng điền :attribute',
            'gender.digits_between' => ':Attribute trong phạm vi [:digits_between]',

            'story.string' => ':Attribute dạng chuỗi ký tự',

            'position_index.required' => 'Vui lòng điền :attribute',
            'position_index.numeric' => ':Attribute phải là dạng số',
            'position_index.min' => ':Attribute tối thiểu là :min',

            'pids.required' => 'Vui lòng điền :attribute',
            'pids.numeric' => ':Attribute phải là dạng số',

            'mid.required' => 'Vui lòng điền :attribute',
            'mid.numeric' => ':Attribute phải là dạng số',

            'fid.required' => 'Vui lòng điền :attribute',
            'fid.numeric' => ':Attribute phải là dạng số',
        ];
    }

    public function attributes()
    {
        return [
            'relation' => 'mối quan hệ',
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
            'pids' => 'id vợ hoặc chồng',
            'mid' => 'id của mẹ',
            'fid' => 'id của cha'
        ];
    }
}
