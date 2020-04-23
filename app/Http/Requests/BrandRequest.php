<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BrandRequest extends FormRequest
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
        if (\Session::has('imageUploaded')) {
            $imageUploaded = \Session::get('imageUploaded');
            $imageUploaded['times'] = 0;
            \Session::put('imageUploaded', $imageUploaded);
        }

        $rules = [
            'name' => 'required|min:3|max:100',
            'notice' => 'nullable|min:10',
            'description' => 'nullable|min:10',
            'phones.*' => 'required|min:6|max:12',
            'bank.*' => 'required',
        ];

        if (Request::isMethod('put')) {
            $rules['mainImage'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000';
        } else {
            $rules['mainImage'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5000';
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Xin mời nhập tên nhà xe',
            'name.min' => 'Tên nhà xe phải có dộ dài ít nhất :min ký tự',
            'name.max' => 'Tên nhà xe phải có dộ dài không quá :max ký tự',
            'notice.min' => 'Lưu ý phải có dộ dài ít nhất :min ký tự',
            'phones.*.required' => 'Xin mời nhập số điện thoại',
            'phones.*.min' => 'Số điện thoại phải có độ dài ít nhất :min ký tự',
            'phones.*.max' => 'Số điện thoại phải có độ dài không quá :max ký tự',
            'bank.*.required' => 'Xin mời nhập số tài khoản ngân hàng',
            'description.min' => 'Mô tả phải có độ dài ít nhất :min ký tự',
            'mainImage.required' => 'Xin mời chọn ảnh',
            'mainImage.image' => 'Ảnh không đúng định dạng',
            'mainImage.mimes' => 'Ảnh không đúng định dạng',
        ];
    }
}
