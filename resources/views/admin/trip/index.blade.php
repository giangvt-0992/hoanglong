@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Chuyến</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Danh sách chuyến</h2>
						<a href="{{route('admin.trip.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm chuyến</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th class="text-center">Tên</th>
									<th class="text-center">Giờ đi</th>
									<th class="text-center">Giờ đến</th>
									{{-- <th class="text-center">Lịch đón khách</th> --}}
									{{-- <th class="text-center">Lịch trả khách</th> --}}
									<th class="text-center">Loại xe</th>
									<th class="text-center">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($trips as $trip)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="text-center" style="max-width: 160px;">{{$trip->name}}</td>
									<td class="text-center">{{date('H:i', strtotime($trip->depart_time))}}</td>
									<td class="text-center">{{date('H:i', strtotime($trip->arrive_time))}}</td>
									{{-- <td class="text-center"></td> --}}
									{{-- <td class="text-center"></td> --}}
									<td class="text-center">{{$trip->carType->name}}</td>
									<td class="text-center"><a href="{{route('admin.trip.update', ['route' => $trip->id])}}" class="btn btn-warning" title="Cập nhật"><i class="fas fa-pencil-alt"></i></a> <a href="{{route('admin.trip.destroy', ['route' => $trip->id])}}" class="btn btn-danger btn-delete" data-page="trip" title="Xóa"><i class="fa fa-trash"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('after-scripts')
<script>
	$("#datatable").DataTable();
</script>
@endsection
