<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
            'province_id' => 'required',
            'name' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'province_id.required' => 'Xin mời chọn tỉnh thành',
            'name.required' => 'Xin mời nhập tên quận huyện',
            'name.min' => 'Số điện thoại phải có độ dài ít nhất :min ký tự',
        ];
    }
}
