@extends('web.layout.master')
@section('content')
<section class="mainContentSection packagesSection boxbooking">
  <div class="container">
    <div class="row tabsPart">
      <div class="col-sm-12">
        <div role="tabpanel">
          <div class="tab-content">
            <div class="step3" style="display: ;">
              <a href="javascript:;" class="btn buttonTransparent btnGoToStep" data-step="2">Trở lại bước 2</a>
              <div class="panel panel-default pnlconfirminfo packagesFilter margin-top-10">
                <div class="panel-heading">
                  <h3 class="panel-title">Xác nhận thông tin đặt vé</h3>
                </div>
                <div class="panel-body confirminfo ">
                  <input type="hidden" id="hddep" value="10">
                  <input type="hidden" id="hdshift" name="shift" value="134">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          {{ __('Fullname')}}
                        </td>
                        <td id="passengerNameTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Phone')}}
                        </td>
                        <td id="passengerPhoneTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Email')}}
                        </td>
                        <td id="passengerEmailTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Address')}}
                        </td>
                        <td id="passengerAddressTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Brand')}}
                        </td>
                        <td id="brandNameTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Departure')}}
                        </td>
                        <td id="departProvinceTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Destination')}}
                        </td>
                        <td id="desProvinceTbl"></td>
                      </tr>
                      <tr>
                        <td>
                          {{ __('Route')}}
                        </td>
                        <td id="routeNameTbl">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{__('Expected customers will board the car at')}}
                        </td>
                        <td id="dateTbl">
                          <span class="bold"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{__('Quantity')}}
                        </td>
                        <td>
                          <span class="bold" id="quantityTbl"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{__('Ticket price')}}
                        </td>
                        <td >
                          <span class="bold" id="priceTbl"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{__('Total price')}}
                        </td>
                        <td >
                          <span class="bold" id="totalTbl"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{('Payment method')}}
                        </td>
                        <td id="paymenttypeTbl"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                <div class="panel-heading">
                  <h3 class="panel-title"> {{__('Booking confirmation')}} </h3>
                  
                </div>
                <div class="panel-body confirminfo">
                  <div class="row">
                    <div class="col-md-12 listseat">
                      <div class="row limit-seat">
                        @include('web.seat_template.test')
                      </div>
                      <div class="row margin-bottom-10">
                        <div class="col-sm-2 col-xs-12">{{__('Please select seat')}}</div>
                        <div class="col-sm-9 col-xs-12"><span id="selectedSeat">19</span><br><span class="note">(The number of beds will be canceled if you are not successful payment)</span><input type="hidden" name=" seat blockshift blockshift3d" id=" seat blockshift blockshift3d"></div>
                      </div>
                      <div class="row margin-bottom-10">
                        <div class="col-sm-2 col-xs-12">{{__('Select pickup address')}}</div>
                        <div class="col-sm-4 col-xs-12">
                          <select class="form-control" id="slPickupPlace">
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                      {{-- <div class="row margin-bottom-10">
                        <div class="col-sm-4 col-xs-12 col-sm-offset-2">
                          - You should ask any Vietnamese arround you who living in this area, they'll show you the way to this address. Sorry for this inconvenience.
                        </div>
                      </div> --}}
                      <div class="row margin-bottom-10" style="height: 300px; position:relative; overflow: hidden;">
                        <div class="col-md-12">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.041158348587!2d105.79841891458781!3d21.03103909307715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab411d8f991b%3A0x47e9d0d4d8e6d1b2!2zNjggxJDGsOG7nW5nIEPhuqd1IEdp4bqleSwgUXVhbiBIb2EsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1588317701039!5m2!1svi!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" id="mapPickupPlace"></iframe>
                        </div>
                      </div>
                      <div class="col-sm-2 col-xs-12">  {{ __('Verification code')}} </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                        <input type="hidden" name="CapImageText" id="CapImageText" value="383802">
                        <div id="captcha">
                        </div>
                        <input type="text" class="form-control" autocomplete="off"  placeholder="" id="CaptchaCodeText" name="CaptchaCodeText" required="required">
                        <span class="notecaptcha" id="notecaptcha" style="display: none;">({{ __('Incorrect code')}})</span>
                        <span class="note">({{ __('Please enter the verification code')}})</span>
                      </div>
                    </div>
                  </div>
                  <form action="{{route('booking-route', ['locale' => app()->getLocale()])}}" method="POST" class="form" id="form_step3">
                    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                    <input type="hidden" name="passengerName" id="passengerNameHd">
                    <input type="hidden" name="passengerPhone" id="passengerPhoneHd" >
                    <input type="hidden" name="passengerEmail" id="passengerEmailHd" >
                    <input type="hidden" name="passengerAddress" id="passengerAddressHd" >
                    <input type="hidden" name="price" id="priceHd">
                    <input type="hidden" name="quantity" id="quantityHd">
                    <input type="hidden" name="date" id="dateHd">
                    <input type="hidden" name="paymenttype" id="paymenttypeHd">
                    <input type="hidden" name="tddId" id="tddIdHd">
                    <input type="hidden" name="brandId" id="brandIdHd">
                    <input type="hidden" name="departName" id="departNameHd">
                    <input type="hidden" name="departTime" id="departTimeHd">
                    <input type="hidden" name="desName" id="desNameHd">
                    <input type="hidden" name="desTime" id="desTimeHd">
                    <input type="hidden" name="routeName" id="routeNameHd">
                    <input type="hidden" name="depProvinceName" id="depProvinceNameHd">
                    <input type="hidden" name="desProvinceName" id="desProvinceNameHd">
                    <div class="listseat ">
                      
                      <div class="row">
                        <div class="col-sm-2 col-xs-12"></div>
                        <div class="col-sm-9 col-xs-12 form-group">
                          <input type="button" value="{{__('Book ticket')}}" class="btn buttonCustomPrimary btnConfirmTicket" data-culture="vi">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('after-scripts')
<script>
  let selectedSeat = [];
  $('.seat').click(function () {
    const quantity = parseInt(bill.quantity);
    if (selectedSeat.length <= quantity) {
      Alert.Warning("So luong ghe da vuot qua gioi han.");
      return;
    }
    $(this).toggleClass('seat-default');
    $(this).toggleClass('seat-blue');
    const index = selectedSeat.indexOf($(this).attr('data-id'));
    if (index === -1) {
      
      selectedSeat.push($(this).attr('data-id'));
    } else {
      selectedSeat = [ ...selectedSeat.slice(0,index), ...selectedSeat.slice(index+1)];
    }
    $('#selectedSeat').text(selectedSeat.join(','));
  });

  // $('.seat-blue').click(function () {
  //   $(this).toggleClass('seat-blue');
  //   $(this).toggleClass('seat-default');
  // });
</script>
@endsection