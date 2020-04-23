@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<h3>Nhà xe</h3>
			</div>
			
			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Tìm kiếm!</button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<a href="{{route('admin.brand.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Thêm</a>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>STT</th>
									<th>Tên hãng</th>
									<th>Mô tả</th>
									<th>Trạng thái</th>
									{{-- <th>Số điện thoại</th> --}}
									<th>Hành động</th>
								</tr>
							</thead>
							
							
							<tbody>
								@foreach ($brands as $brand)
								<tr>
									<td>{{$loop->index + 1 }}</td>
									<td>{{$brand->name}}</td>
									<td>{{$brand->description}}</td>
									<td>{{$brand->is_active == true ? 'Kích hoạt' : 'Ngưng kích hoạt'}}</td>
									{{-- <td>{{$brand->phone}}</td> --}}
									<td>
										<a class="btn btn-primary" href="{{route('admin.brand.update', ['brand' => $brand->id])}}"><i class="fa fa-pencil"></i> Sửa</a>
										@if ($brand->is_active == config('constants.IS_ACTIVE_STATUS.ACTIVE'))
										<a class="btn btn-danger btn-deactive" href="{{route('admin.brand.destroy', ['brand' => $brand->id])}}"><i class="fa fa-trash"></i> Ngưng kích hoạt</a>
										@else 
										<a class="btn btn-success btn-active" href="{{route('admin.brand.active', ['brand' => $brand->id])}}"><i class="fa fa-recycle"></i> Kích hoạt</a>
										@endif
									</td>
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
