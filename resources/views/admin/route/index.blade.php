@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Tuyến đường</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Danh sách tuyến đường</h2>
						<a href="{{route('admin.route.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm tuyến đường</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th class="text-center">Tên</th>
									<th class="text-center">Điểm đi</th>
									<th class="text-center">Điểm đến</th>
									<th class="text-center">Khoảng cách</th>
									<th class="text-center">Thời gian</th>
									<th class="text-center">Giá</th>
									<th class="text-center">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($routes as $route)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="text-center" style="max-width: 160px;">{{$route->name}}</td>
									<td class="text-center">{{$route->departPlace->name}}</td>
									<td class="text-center">{{$route->desPlace->name}}</td>
									<td class="text-center">{{number_format($route->distance) . ' km'}}</td>
									<td class="text-center">{{$route->duration->hours . ':' . $route->duration->minutes}}</td>
									<td class="text-center">{{number_format($route->price)}}</td>
									<td class="text-center">
										<a href="{{route('admin.route.update', ['route' => $route->id])}}" class="btn btn-warning" title="Cập nhật"><i class="fas fa-pencil-alt"></i></a>
										@if ($route->getOriginal('is_active'))
										<a href="{{route('admin.route.inactive', ['route' => $route->id])}}" class="btn btn-dark" title="Ngưng kích hoạt"><i class="fas fa-ban"></i></a>
										@else
										<a href="{{route('admin.route.active', ['route' => $route->id])}}" class="btn btn-success" title="Kích hoạt"><i class="fas fa-recycle"></i></a>
										@endif
										<a href="{{route('admin.route.destroy', ['route' => $route->id])}}" class="btn btn-danger btn-delete" data-page="route" title="Xóa"><i class="fa fa-trash"></i></a></td>
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
