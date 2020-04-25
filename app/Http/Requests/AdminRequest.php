<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|max:100',
            'rePassword' => 'same:password',
            'brandId' => 'required',
            'roleId' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng không được để trống',
            'name.min' => 'Tên người dùng phải có độ dài ít nhất :min ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có độ dài ít nhất :min ký tự',
            'password.max' => 'Mật khẩu phải có độ dài không quá :max ký tự',
            'rePassword.same' => 'Mật khẩu không khớp',
            'brandId.required' => 'Xin mời chọn nhà xe',
            'roleId' => 'Xin mời chọn quyền người dùng',
        ];
    }
}
