@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Địa điểm</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Danh sách địa điểm</h2>
						<a href="{{route('admin.place.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm địa điểm</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Tên</th>
									<th>Mô tả</th>
									<th>Địa chỉ</th>
									<th>Map</th>
									<th>Khu vực</th>
									<th class="text-center">Cập nhật</th>
									<th class="text-center">Xóa</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($places as $place)
								<tr>
									<td>{{$place->name}}</td>
									<td>{{$place->description}}</td>
									<td>{{$place->address}}</td>
									<td class="shorter">{{$place->map_url}}</td>
									<td>{{$place->district->name}}</td>
									<td class="text-center"><a href="{{route('admin.place.update', ['place' => $place->id])}}" class="btn btn-warning" ><i class="fa fa-pencil"></i></a></td>
									<td class="text-center"><a href="{{route('admin.place.destroy', ['place' => $place->id])}}" class="btn btn-danger btn-delete" data-page="place"><i class="fa fa-trash"></i></a></td>
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
