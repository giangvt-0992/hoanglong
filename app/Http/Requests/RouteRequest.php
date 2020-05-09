<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'departPlaceId' => 'required',
            'desPlaceId' => 'required|different:departPlaceId',
            'distance' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'price' => 'required',
            'listPassingPlaceId' => 'required',
            'description' => 'nullable|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tuyến đường không được để trống',
            'name.min' => 'Tên tuyến đường phải có độ dài ít nhất :min ký tự',
            'departPlaceId.required' => 'Điểm đi không được để trống',
            'desPlaceId.required' => 'Điểm đến không được để trống',
            'desPlaceId.different' => 'Điểm đến không được trùng với điểm đi',
            'distance.required' => 'Khoảng cách không được để trống',
            'hours.required' => 'Số giờ không được để trống',
            'minutes.required' => 'Số phút không được để trống',
            'price.required' => 'Giá tiền không được để trống',
            'listPassingPlaceId.required' => 'Danh sách điểm đón không được để trống',
            'description.min' => 'Mô tả phải có độ dài ít nhất :min ký tự',
        ];
    }
}
