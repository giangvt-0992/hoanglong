<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Xin mời nhập mật khẩu cũ',
            'new_password.required' => 'Xin mời nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
            'new_password.confirmed' => 'Mật khẩu mới không khớp',
        ];
    }
}
