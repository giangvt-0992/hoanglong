<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'address' => 'required|min:10',
            'map' => 'required|min:10',
            'description' => 'nullable|min:10',
            'districtId' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên địa điểm không được để trống',
            'name.min' => 'Tên địa điểm phải có độ dài ít nhất :min ký tự',
            'address.required' => 'Địa chỉ không được để trống',
            'address.min' => 'Địa chỉ phải có độ dài ít nhất :min ký tự',
            'map.required' => 'Địa chỉ bản đổ không được để trống',
            'map.min' => 'Địa chỉ bản đổ phải có độ dài ít nhất :min ký tự',
            'description.min' => 'Mô tả phải có độ dài ít nhất :min ký tự',
            'districtId.required' => 'Khu vực không được để trống',
        ];
    }
}
