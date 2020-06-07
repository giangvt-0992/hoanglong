@if ($data['locale'] == 'vi')
<p>Cảm ơn bạn đã sử dụng dịch vụ đặt vé xe khách trực tuyến online tại trang web <a href="href="http://localhost">giangtuan.com</a></p>
<p>Do có sự cố nên lịch trình chuyến đi {{$data['trip']}} đã bị hủy</p>
<p>Mã vé xe của quý khách là: <span style="color: red">{{$data['code']}}</span></p>
<p>Quý khách vui lòng liên hệ với nhà xe để biết thêm thông tin chi tiết về lịch trình</p>
@else
Giang Tuấn Transportation Co.,Ltd thank you for using book ticket online service from the website <a href="http://hoanglongasia.com" target="_blank">http://hoanglongasia.com</a><br>
<br/>
<p>Because of some problem, the trip {{$data['trip']}} was canceled</p>
<p>Your ticket code is: <span style="color: red">{{$data['code']}}</span></p>
<p>Please contact the garage for more details on the schedule</p>
@endif
