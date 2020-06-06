<div id=":1kz" class="a3s aXjCH ">{{__('Hello')}} {{$data['passengerName']}}<br>
  @if (app()->getLocale() == 'vi')
  <br>
  Cong ty TNHH Van tai Giang Tuan cam on ban da su dung dich vu dat ve truc tuyen qua mang Internet tu website <a href="http://hoanglongasia.com" target="_blank">http://hoanglongasia.com</a><br>
  <br>
  Chúng tôi nhận được yêu cầu hủy đặt vé xe có mã số: <strong>{{$data['ticketCode']}}</strong><br>
  Đây là mã xác nhận của hủy vé đặt xe của bạn: <h2><strong style="color:red">{{$data['cancelTicketCode']}}</strong></h2><br>
  @else
  Giang Tuấn Transportation Co.,Ltd thank you for using book ticket online service from the website <a href="http://hoanglongasia.com" target="_blank">http://hoanglongasia.com</a><br>
  <br>
  We receive a request to cancel a booking with the following code: <h2><strong>{{$data['ticketCode']}}</strong></h2><br>
  Here is the confirmation code for canceling your booking:<strong style="color:red">{{$data['cancelTicketCode']}}</strong><br>
  @endif
</div>
