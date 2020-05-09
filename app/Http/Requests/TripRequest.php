<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TripRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // echo('<pre>');
        // print_r($request->all());
        // echo('<pre>');
        // exit();
        // foreach ($request->schedule as $schedule) {
        //     echo('<pre>');
        //     print_r($schedule);
        //     echo('<pre>');
        //     // exit();
        // }
        // exit();
        return [
            'routeId' => 'required',
            'name'  => 'required|min:3',
            'departTime' => 'required',
            'arriveTime' => 'required',
            'schedule.*.time' => 'required',
            'schedule.*.place_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'routeId.required' => 'Xin mời chọn tuyến xe',
            'name.required'  => 'Tên chuyến không được để trống',
            'name.min'  => 'Tên chuyến phải có độ dài ít nhất :min ký tự',
            'departTime.required'  => 'Giờ đi không được để trống',
            'arriveTime.required'  => 'Giờ đến không được để trống',
            'schedule.*.time.required'  => 'Thời gian đón khách không được để trống',
            'schedule.*.place_id.required' => 'Địa điểm đón khách không được để trống',
        ];
    }
}
