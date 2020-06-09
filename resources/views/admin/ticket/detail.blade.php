@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Vé xe/ Chi tiết vé xe</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Chi tiết vé xe</h2>
						<div class="clearfix"></div>
						{{-- <a href="{{route('admin.route.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm tuyến đường</a> --}}
					</div>
					<div class="x_content">
						<table class="table table-bordered" id="">
							{{-- <tdead>
								<tr>
									<td class=""></td>
									<td class=""></td>
								</tr>
							</tdead> --}}
							<tbody>
								<tr>
                  <td class=""><b>Mã vé</b></td>
                  <td class=""><b>{{$ticket->code}}</b></td>
                </tr>
								<tr>
                  <td class=""><b>Tên hành khách</b></td>
                  <td class=""><b>{{$ticket->passenger_info['name']}}</b></td>
                </tr>
								<tr>
                  <td class="text-bold">Số điện thoại</td>
                  <td class="text-bold">{{$ticket->passenger_info['phone']}}</td>
                </tr>
								<tr>
                  <td class="text-bold">Email</td>
                  <td class="text-bold">{{$ticket->passenger_info['email']}}</td>
                </tr>
								<tr>
                  <td class="">Địa chỉ</td>
                  <td class="">{{$ticket->passenger_info['address'] ?? 'chưa có thông tin'}}</td>
                </tr>
								<tr>
                  <td class="">Chuyến</td>
                  <td class="">{{$ticket->trip_info['trip_name'] }}</td>
                </tr>
								<tr>
                  <td class="">Đơn giá</td>
                  <td class="">{{number_format($ticket->trip_info['unit_price'])}} VND</td>
                </tr>
								<tr>
                  <td class="">Số lượng</td>
                  <td class="">{{$ticket->quantity}}</td>
                </tr>
								<tr>
                  <td class="">Ghế đã đặt</td>
                  <td class="">{{$ticket->getListSeatString()}}</td>
                </tr>
								<tr>
                  <td class="">Thành tiền</td>
                  <td class="">{{number_format($ticket->total)}} VND</td>
                </tr>
								<tr>
                  <td class="">Giờ đi - giờ đến</td>
                  <td class="">{{date('H:i', strtotime($ticket->trip_info['depart_time'])) . ' - ' . date('H:i', strtotime($ticket->trip_info['des_time']))}}</td>
                </tr>
								<tr>
                  <td class="">Ngày đi</td>
                  <td class="">{{date('d-m-Y', strtotime($ticket->tripDepartDate->depart_date))}}</td>
                </tr>
								<tr>
                  <td class="text-bold"><b>Điểm lên xe - thời gian lên</b></td>
                  <td class="text-bold"><b>{{$ticket->trip_info['pickup_place'] . ' - ' . date('H:i', strtotime($ticket->trip_info['pickup_time']))}}</b></td>
                </tr>
								<tr>
                  <td class=""><b>Trạng thái vé</b></td>
                  <td class="{{$ticket->getStatusColor()}}"><b>{{$ticket->status}}</b></td>
                </tr>
							</tbody>
						</table>
						@if ($ticket->nextStatus && !$isExpired)
						<form action="{{route('admin.ticket.update_status', ['ticket_code' => $ticket->code])}}" method="POST" id="frmUpdateStatus">
							{{ csrf_field() }}
							<input type="hidden" name="status" value="{{$ticket->getNextStatus()}}">
							<button class="btn btn-{{$ticket->getNextStatusColor()}} float-right" id="btnChangeStatus">{{$ticket->nextStatus}}</button>
						</form>
						@else
						<p>Lưu ý: chỉ có thể đổi trạng thái vé trước 6 tiếng trước khi xe chạy</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('after-scripts')
<script>

	$("#btnChangeStatus").click(function (e) {
		e.preventDefault();
		Swal.fire({
			title: 'Xác nhận đổi trạng thái?',
			text: "Bạn có muốn đổi trạng thái vé này không!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Xác nhận!',
			cancelButtonText: 'Hủy!'
		}).then((result) => {
			if (result.value) {
				$("#frmUpdateStatus").submit();
			}
		});
	});
	
</script>
@endsection
