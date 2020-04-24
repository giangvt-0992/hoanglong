<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'permissions' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên quyền không được để trống',
            'name.min' => 'Tên quyền phải có độ dài ít nhất :min ký tự',
            'permissions.required' => 'Xin mời chọn ít nhất một quyền',
        ];
    }
}
