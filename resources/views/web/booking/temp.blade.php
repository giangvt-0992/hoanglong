@extends('master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url(public/source/Content/themes/startravel/img/pages/page-title-hcm.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1> {{ __('Reserve your ticket') }}</h1>
                            <div class="under-border"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="position: fixed; top: 0; width:100%; z-index: 1111; height: 100%; background-color: rgba(0,0,0,0.5); display:none;" id="pageLoading">
    <div style="position: absolute; top: 45%; left: 40%;" class="text-center">
        <i class="fa fa-spinner fa-spin" style="font-size:70px; color: wheat;"></i>
        <p style="font-size:20px; color: wheat;"> {{ __('Data is in processing') }} ...</p>
    </div>
 </div>
<?php 
    $step = 0;
    if (Session::has('step')) {
        $step = Session::get('step');
    }
?>
<section class="mainContentSection packagesSection boxbooking">
    <div class="container">
        <div class="row tabsPart">
            <div class="col-sm-12">
                <div role="tabpanel">
                    {{-- <ul class="nav nav-tabs tabbn" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#oneway" aria-controls="oneway" role="tab" data-toggle="tab" aria-expanded="true" data-tickettype="0" data-culture="vi">
                                Đặt v&#233; một chiều
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#roundtrip" aria-controls="roundtrip" role="tab" data-toggle="tab" aria-expanded="true" data-tickettype="1" data-culture="vi">
                                Đặt v&#233; khứ hồi
                            </a>
                        </li>
                    </ul> --}}
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="oneway">
                            <div class="row progress-wizard hidden-xs" style="border-bottom:0;">
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-1">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        1. Tìm chuyến
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-2">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        2. Nhập thông tin
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-3">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        3. Xác nhận thông tin
                                    </a>
                                </div>

                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-4">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        4. Đặt vé thành công
                                    </a>
                                </div>
                            </div>
                            
                            <div class="positiontop"></div>
                            <div class="step1 bookinghcm " style="@if($step == 'step3') display:none;  @endif">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="darkSection citiesPage">
                                            <div class="row gridResize">
                                                <div class="col-sm-3 col-xs-12">
                                                    <div class="sectionTitleDouble">

                                                        <h2>Đặt <span>Vé</span></h2>
                                                        <a href="/dat-ve-cat-ba" class="book-other">Đặt vé <span>Cát Bà</span></a>
                                                        <a href="/dat-ve-chuyen-ngan" class="book-other">Đặt vé <span>Hà Nội - Hải Phòng</span></a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-xs-12">
                                                    <form action="{{route('booking')}}" method="post" id="form">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        {{-- <input type="hidden" name="isAPI" value="0" /> --}}
                                                        <?php 
                                                        if($step == 'step1'){
                                                            $cart = Session::get('cart'); 
                                                            $destination = $cart['destination']['id'];
                                                            $destination_name = $cart['destination']['name'];
                                                            $departure = $cart['departure']['id'];
                                                            $departure_name = $cart['departure']['name'];
                                                            $quantity = $cart['quantity'];
                                                            $date = $cart['date'];
                                                        }else {
                                                            $destination = -1;
                                                            $date = $nextdate;
                                                            $departure = -1;
                                                            $quantity = 0;
                                                        }
                                                        if(\Cookie::has('customerInfo')){
                                                            $cus_info = \Cookie::get('customerInfo');
                                                            $cus_info = json_decode($cus_info);
                                                        }
                                                        
                                                        $user = auth('guess')->user();

                                                        ?>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="departure" name="departure"><option value="" selected>Điểm đi</option>
                                                                        @foreach($places as $key => $value)
                                                                        <option value="{{$key}}" @if($departure == $key) selected @endif>{{$value}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="destination" name="destination"><option value="">Điểm đến</option>
                                                                        @foreach($places as $key => $value)
                                                                        <option value="{{$key}}" @if($destination == $key) selected @endif>{{$value}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="input-group date ed-datepicker">
                                                                    <input type="text" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" id="datebook" name="date" readonly="readonly" value="{{$date}}">
                                                                    <div class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <input type="hidden" id="hddate" />
                                                                <input type="hidden" id="hdculture" value="vi" />
                                                                <input type="hidden" name="step" value="step1">
                                                                <input type="button" value="Tìm chuyến" class="btn buttonCustomPrimary btnSearchShift" data-blank="1" />

                                                                
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select name="quantity" class="select2bootstrap" id="quantity">
                                                                        <?php $i = 1; ?>
                                                                        @while($i < 6)
                                                                        <option value="{{$i}}" @if($quantity == $i) selected @endif>{{$i}}</option>
                                                                        <?php $i++; ?>
                                                                        @endwhile
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if( $step == 'step1')
                                <div class="row">
                                    <div class="col-sm-12  loadshifthcm">
                                        <div class="panel panel-default packagesFilter">
                                            <div class="panel-heading">
                                                <b>KẾT QUẢ TÌM KIẾM CHUYẾN XE </b>
                                            </div>
                                            <div class="note" style="padding:10px" id="note">
                                                (Điểm đi <a target="_blank" href="/van-phong-dai-ly/8">@if(Session::has('cart')) <?php $cart = Session::get('cart'); echo($departure_name)?> @endif</a> đến <a target="_blank" href="">@if(Session::has('cart')) <?php echo($destination_name)?> @endif</a> Ngày đi {{date('d-m-Y', strtotime($date)) }})
                                            </div>
                                            <div class="panel-body resultbooking">
                                                <div class="listshift">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="hidden-xs hidden-sm">Mã chuyến</th>
                                                                <th class="hidden-xs hidden-sm">Điểm đi</th>
                                                                <th>Giờ đi</th>
                                                                <th class="hidden-xs hidden-sm">Điểm đến</th>
                                                                <th class="hidden-xs hidden-sm">Giờ đến</th>
                                                                <th class="hidden-xs hidden-sm">Thời gian</th>
                                                                <th>Chỗ trống</th>
                                                                <th class="hidden-xs hidden-sm">Loại xe</th>
                                                                <th>Giá vé </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($shiftInfo as $info)
                                                            <tr>
                                                                <td class="hidden-xs hidden-sm">{{$info->buses_id}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$departure_name}}</b></td>
                                                                <td>{{$info->depart_time}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$destination_name}}</b></td>
                                                                <td class="hidden-xs hidden-sm">{{$info->arrive_time}}</td>

                                                                <td class="hidden-xs hidden-sm">{{$info->duration}}</td>

                                                                <td><b>{{$info->available_seats}}</b></td>
                                                                <td class="hidden-xs hidden-sm"></td>
                                                                <td>{{number_format($info->price)}}</td>
                                                                <td>
                                                                    <a class="btn buttonTransparent btnSetVehicleId" data-id="{{$info->buses_id}}" data-dep="{{$info->departure}}" data-dep-name="{{$cart['departure']['name']}}" data-des="{{$info->destination}}" data-des-name="{{$cart['destination']['name']}}" data-starttime="{{$info->depart_time}}" data-date="{{$cart['date']}}" data-price="{{$info->price}}" data-datecheck="{{$cart['date']}}" data-quantity="{{$cart['quantity']}}"  data-chuyen="{{$info->buses_name}}" data-des-time="{{$info->depart_time}}">Đặt vé</a>

                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="bottombooking">
                                                    <div>
                                                        <u>Lưu ý:</u><br>
                                                        + <b>Điểm đi:</b> là điểm xuất bến của quý khách.<br>
                                                        + <b>Giờ đi:</b> là giờ dự kiến xuất bến trong ngày.<br>
                                                        + <b>Điểm đến:</b> là điếm đến bến cuối của quý khách.<br>
                                                        + <b>Giờ đến:</b> là giờ dự kiến đến thời gian này quý khách sẽ đến bến cuối.<br>
                                                        + <b>Thời gian:</b> là tổng thời gian dự kiến hành trình của xe.<br>
                                                        + <b>Chỗ trống:</b> Số lượng chỗ còn trống trên chuyến xe. Do quý khách chưa thanh toán lên số chỗ là mặc định theo từng loại xe.<br>
                                                        + <b>Giá vé:</b> Giá tiền được định giá quý khách phải trả để đi xe Giang Tuấn trên hành trình chọn.<br>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div><!--end panel-default-->
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end class step1-->
                            <div class="step2" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <form action="#" class="form" id="frBookingStep2" method="post"> 
                                            <a href="javascript:void(0)" class="btn buttonTransparent btnGoToStep" data-step="1">Trở lại bước 1</a>
                                            <div class="panel panel-default margin-top-10 pnlcustomerinfo packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Thông tin khách hàng</h3>
                                                </div>
                                                <div class="panel-body customerinfo">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">
                                                                Họ và tên (*)
                                                            </label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text" name="customername" id="customername" required="required" 
                                                                @if(isset($cus_info)) 
                                                                    value="{{$cus_info->name}}" 
                                                                @else 
                                                                    @if($user != null)
                                                                        value="{{$user->username}}"
                                                                    @endif
                                                                @endif
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Số điện thoại (*)</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text " name="phone" id="phone" required="required"  @if(isset($cus_info)) 
                                                                value="{{$cus_info->phone}}" 
                                                            @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Email (*)</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="email" class="form-control input-sm text " name="email" id="email" required="required" 
                                                                @if(isset($cus_info)) 
                                                                    value="{{$cus_info->email}}" 
                                                                @else 
                                                                    @if($user != null)
                                                                        value="{{$user->email}}"
                                                                    @endif
                                                                @endif
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Địa chỉ</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text " name="address" id="address" <?php if(isset($cus_info)) echo 'value = "' . $cus_info->address . '"'?>>
                                                            </div>
                                                        </div>
                                                    </div>                   
                                                </div>
                                            </div>
                                            <div class="panel panel-default pnltransaction margin-top-10 packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Hình thức giao dịch</h3>
                                                </div>
                                                <div class="panel-body transaction">



                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="paymenttype" {{-- id="paymenttype" --}} value="1"> Thanh toán trực tiếp
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="panel panel-default pnlrules margin-top-10 packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Các điều kiện vận chuyển</h3>
                                                </div>
                                                <div class="panel-body rules">
                                                    <ol class="padding-left-20">
                                                        <li style="padding-bottom: 5px;">Vì lợi ích của khách hàng và công ty, khách hàng nên mang theo CMND khi sử dụng dịch vụ.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng có mặt tại điểm đón khách của Hảo Nguyên theo hướng dẫn của nhân viên bán vé trước giờ xe chạy ít nhất 30 phút để làm thủ tục.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không được hút thuốc trên xe.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không mang theo những hàng hóa nguy hiểm, động vật tươi sống, quý hiếm, hàng bị cấm lưu thông như vũ khí, các chất dễ cháy nổ, những thứ có mùi độc hại lên xe.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không mang theo những hàng hóa cấm trong danh mục quy định hàng cấm của nước Cộng Hoà Xã Hội Chủ Nghĩa Việt Nam.</li>
                                                        <li style="padding-bottom: 5px;">Vé chỉ có giá trị theo chuyến ngày và giờ ghi trên vé.</li>
                                                        <li style="padding-bottom: 5px;">
                                                            Quý khách được quyền Hủy vé/thay đổi thông tin chuyến dựa vào THỜI gian DỰ KIẾN XUẤT BẾN :
                                                            trước 12 tiếng được hủy/đổi miễn phí, từ 03 đến 12 tiếng được hủy/đổi và mất phí dịch vụ 10%,
                                                            trong vòng 03 tiếng được hủy/đổi và mất phí dịch vụ 30%.
                                                            Giá trị Vé sau khi trừ phí sẽ được hoàn lại trong vòng 03 ngày kể từ khi hủy vé.
                                                            Ngày Lễ - Tết có Quy định riêng
                                                        </li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không được hủy, thay đổi thông tin khi mất vé này, khách hàng vẫn có thể đi xe nếu còn nhớ mã vé và mang theo CMND.</li>
                                                        <li style="padding-bottom: 5px;">Nếu vì điều kiện bất khả kháng (Thiên tai, tắc đường…) Công ty được quyền hủy hoặc thay đổi lịch và giờ chạy. Công ty có trách nhiệm thông báo trước mà không chịu bất cứ trách nhiệm nào.</li>
                                                        <li style="padding-bottom: 5px;">Mỗi hành khách được mang theo 30kg hành lý. Nếu vượt quá mức quy định thì phải đóng thêm phụ phí là 5000đ/kg. Các thiết bị máy móc,ti vi, máy tính cồng kềnh, xe máy... trong danh mục quy định hàng hóa của Công ty, không được tính là hành lý mang theo.</li>
                                                        <li style="padding-bottom: 5px;">Trong trường hợp khách hàng cho rằng nhân viên của công ty có những hành vi thiếu lịch sự hoặc sai quy chế, chúng tôi luôn tiếp nhận ý kiến của khách hàng theo số điện thoại, email, thư tay ở phần thông tin liên lạc.</li>
                                                    </ol>
                                                    <p></p><h3><u>Thông tin liên lạc</u></h3><p></p>
                                                    <ol class="padding-left-20">
                                                        <li style="padding-bottom: 5px;">Đường dây nóng:  <strong>0326522626</strong> - 0326522626 - 0326522626</li>
                                                        <li style="padding-bottom: 5px;">Email:giangtuan6199@gmail.com</li>
                                                        <li style="padding-bottom: 5px;">Địa chỉ: Phòng Điều hành trung tâm, Công ty TNHH vận tải Giang Tuấn, Số 21 Ngõ 41 Đông Tác Đống Đa Hà Nội</li>
                                                        <li style="padding-bottom: 5px;">Đặt vé trực tuyến: <a href="/dat-ve-bac-nam" title="booking online">http://www.giangtuan6199.com/dat-ve</a></li>
                                                    </ol>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="privacy" name="privacy" value="1" disabled="disabled"> Tôi đồng ý với các điều khoản sử dụng dịch vụ<br>
                                                        </label>
                                                    </div>
                                                    <input type="submit" class="btn buttonCustomPrimary" disabled="disabled" id="confirm-button" data-culture="vi" value="Xác nhận đặt vé">
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!--end step2-->
                            <div class="step3" style="display: none;">
                                <a href="javascript:;" class="btn buttonTransparent btnGoToStep" data-step="2">Trở lại bước 2</a>
                                <div class="panel panel-default pnlconfirminfo packagesFilter margin-top-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận thông tin đặt vé</h3>
                                    </div>
                                    <div class="panel-body confirminfo ">
                                        <input type="hidden" id="hddep" value="10">
                                        <input type="hidden" id="hdshift" name="shift" value="134">
                                        <table class="table ">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Họ và tên
                                                    </td>
                                                    <td id="customername_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số điện thoại
                                                    </td>
                                                    <td id="phone_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email
                                                    </td>
                                                    <td id="email_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Địa chỉ
                                                    </td>
                                                    <td id="address_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Điểm đi - Điểm đến
                                                    </td>
                                                    <td id="de_des"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Chuyến
                                                    </td>
                                                    <td id="chuyen_tb">

                                                        {{-- ??? chưa xong --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Dự kiến khách hàng sẽ lên xe tại Hà Nội lúc:
                                                    </td>
                                                    <td id="date_tb">
                                                        <span class="bold"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số lượng người đi
                                                    </td>
                                                    <td>
                                                        <span class="bold" id="quantity_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Giá vé 
                                                    </td>
                                                    <td >
                                                        <span class="bold" id="price_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tổng tiền
                                                    </td>
                                                    <td >
                                                        <span class="bold" id="total_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Hình thức giao dịch
                                                    </td>
                                                    <td id="paymenttype_tb">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận đặt vé</h3>
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-12">Mã xác nhận</div>
                                            <div class="col-sm-4 col-xs-12 form-group">
                                                <input type="hidden" name="CapImageText" id="CapImageText" value="383802">
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="" id="CaptchaCodeText" name="CaptchaCodeText" required="required">
                                                <span class="notecaptcha" id="notecaptcha" style="display: none;">(Mã không đúng)</span>
                                                <span class="note">(Vui lòng nhập mã xác nhận từ email của bạn)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body confirminfo">
                                        <form action="{{route('booking')}}" method="POST" class="form" id="form_step3">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="step" value="step3">
                                            <input type="hidden" name="paymenttype" id="paymenttype_hd" >
                                            <input type="hidden" name="departure" id="departure_hd">
                                            <input type="hidden" name="destination" id="destination_hd">
                                            <input type="hidden" name="date" id="date_hd">
                                            <input type="hidden" name="starttime" id="starttime_hd">
                                            <input type="hidden" name="price"id="price_hd">
                                            <input type="hidden" name="shift" id="shift_hd">
                                            <input type="hidden" name="shift-id" id="shift_id_hd">
                                            <input type="hidden" name="customername" id="customername_hd">
                                            <input type="hidden" name="phone" id="phone_hd" >
                                            <input type="hidden" name="email" id="email_hd" >
                                            <input type="hidden" name="address" id="address_hd" >
                                            <input type="hidden" name="quantity" id="quantity_hd">
                                            <div class="listseat ">
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-12"></div>
                                                    <div class="col-sm-9 col-xs-12 form-group">
                                                        {{-- <input type="hidden" name="seat" id="seat"> --}}
                                                        <input type="button" value="Đặt vé" class="btn buttonCustomPrimary btnConfirmTicket" data-culture="vi">
                                                        <input type="button" value="Gửi lại" class="btn buttonCustomPrimary" id="btnSendCodeAgain">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <!--end step3-->
                            @if($step == 'step3')
                            
                            @if(isset($result))
                                @if($result == true)
                                <div class="step4" style="display: block;">
                                    <div class="panel panel-default pnlconfirminfo packagesFilter">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Xác nhận thông tin đặt vé</h3>
                                        </div>

                                        <div class="panel-body confirminfo row-fluid">
                                            <input type="hidden" id="hddep" value="10">
                                            <input type="hidden" id="hdshift" name="shift" value="4">
                                            <table class="table table-bordered">
                                                <tbody><tr>
                                                    <td>
                                                        Mã đặt vé
                                                    </td>
                                                    <td>
                                                        <span class="bold">{{$detail['ticket_id']}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Họ và tên
                                                    </td>
                                                    <td>
                                                        {{$detail['customername']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số điện thoại
                                                    </td>
                                                    <td>
                                                        {{$detail['phone']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email
                                                    </td>
                                                    <td>
                                                        {{$detail['email']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Địa chỉ
                                                    </td>
                                                    <td>
                                                        {{$detail['address']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Điểm đi - Điểm đến
                                                    </td>
                                                    <td>
                                                        {{$detail['departure'] .' - '. $detail['destination']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Chuyến
                                                    </td>
                                                    <td>
                                                        {{$detail['shift']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Dự kiến khách hàng sẽ lên xe tại Hà Nội lúc:
                                                    </td>
                                                    <td>
                                                        <span class="bold">{{$detail['starttime'] . ' Ngày ' . $detail['date']}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số lượng người đi 
                                                    </td>
                                                    <td>
                                                        <span class="bold">{{$detail['quantity']}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Giá vé 
                                                    </td>
                                                    <td>
                                                        <span class="bold">{{number_format($detail['price'])}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tổng tiền
                                                    </td>
                                                    <td>
                                                        <span class="bold">{{number_format($detail['quantity']*$detail['price'])}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Hình thức giao dịch
                                                    </td>
                                                    <td>
                                                        Thanh toán trực tiếp
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Xác nhận đặt vé</h3>
                                        </div>
                                        <div class="panel-body confirminfo row-fluid">
                                            <div class="row-fluid" style="padding:10px;">
                                                <h3>Bạn đã đặt vé thành công</h3>
                                                <p>
                                                    Cảm ơn quý khách đã sử dụng dịch vụ đặt vé trực tuyến của Công ty Vận tải Giang Tuấn.
                                                </p>
                                                <span style="font-style:italic">
                                                    Chúng tôi đã gửi cho bạn một email vào địa chỉ {{$detail['email']}}<br>
                                                    Xin vui lòng kiểm tra email để được mã code vé, hướng dẫn thủ tục thanh toán và lấy vé.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div>
                                    <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Hết vé</h3>
                                        </div>
                                        <div class="panel-body confirminfo row-fluid">
                                            <div class="row-fluid" style="padding:10px;">
                                                <h3>Chuyến xe này không đủ số lượng vé yêu cầu, quý khách vui lòng chọn chuyến xe khác!</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                            @endif
                            <!--end step4-->
                            <hr />

                        </div>
                        <div role="tabpanel" class="tab-pane" id="roundtrip"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- booking --}}

        {{-- <div class="whiteSection">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="sectionTitle">
                        <h2><span>H&#236;nh ảnh giường nằm</span></h2>
                    </div>
                    <img style="width: 90%;" src="public/source/Images/hoanglonggiuong.jpg" title="Hinh anh xe Hoang Long" alt="Hinh anh xe Hoang Long" />
                </div>
            </div>
        </div> --}}
    </div><!--end div container-->

</section>
@endsection
@section('js-lightHeader')
{{-- <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/vendor/jquery/jquery.js')}}"></script> --}}


@endsection
@section('after-scripts')
<script src="{{ url('public/js/booking.js')}}"></script>
@endsection