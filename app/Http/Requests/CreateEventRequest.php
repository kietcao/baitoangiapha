<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'max:200', 'string'],
            'event_times' => ['array', 'required'],
            'event_times.*.start_at' => ['required', 'date_format:H:i'],
            'event_times.*.end_at' => ['required', 'date_format:H:i', 'after:event_times.*.start_at'],
            'event_times.*.description' => ['required', 'string', 'max:500'],
            'join_members' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền :attribute',
            'title.max' => ':Attribute tối đa :max ký tự',
            'title.string' => ':Attribute là kiểu chuỗi ký tự',

            'event_times.array' => ':Attribute là kiểu mảng',
            'event_times.required' => 'Vui lòng thêm :attribute',
            'event_times.*.start_at.required' => 'Vui lòng chọn :attribute',
            'event_times.*.start_at.date_format' => ':Attribute kiểu giờ:phút',
            'event_times.*.end_at.required' => 'Vui lòng chọn :attribute',
            'event_times.*.end_at.date_format' => ':Attribute kiểu giờ:phút',
            'event_times.*.end_at.after' => ':Attribute phải sau thời gian bắt đầu',
            'event_times.*.description.required' => 'Vui lòng điền :attribute',
            'event_times.*.description.string' => ':Attribute kiểu chuỗi',
            'event_times.*.description.max' => ':Attribute tối đa :max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'tiêu đề sự kiện',
            'event_times' => 'thời gian sự kiện',
            'start_at' => 'thời gian bắt đầu',
            'end_at' => 'thời gian kết thúc',
            'event_times.*.start_at' => 'thời gian bắt đầu',
            'event_times.*.end_at' => 'thời gian kết thúc',
            'event_times.*.description' => 'mô tả thời gian',
        ];
    }
}
