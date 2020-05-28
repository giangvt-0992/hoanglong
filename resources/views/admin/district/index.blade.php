@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Khu vực</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<form action="{{route('admin.district.search')}}" method="GET" id="frmSearchTripDD">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<div class="col-md-6 col-xs-12">
						<select class="form-control" name="province_id" id="slProvinceId">
							<option value="" selected>Thành phố</option>
							@foreach($provinces as $province)
							<option value="{{$province->id}}" @if($province->id == Request::get('province_id')) selected @endif>{{$province->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6 col-xs-12">
						<input type="text" name="name" class="form-control" placeholder="Tên quận huyện" value="{{Request::get('name')}}">
					</div>
				</div>
				{{-- <div class="col-md-12">					 --}}
					<div class="col-md-12" style="margin-top: 10px;">
						<button class="btn btn-primary float-right">Tìm kiếm <i class="fas fa-search"></i></button>
					</div>
				{{-- </div> --}}
			</form>
		</div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Danh sách khu vực</h2>
						<a href="{{route('admin.district.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm Khu vực</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered" id="datatable">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th class="text-center">Tên</th>
									<th class="text-center">Tỉnh thành</th>
									{{-- <th class="text-center">Slug</th> --}}
									<th class="text-center">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($districts as $district)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="text-center">{{$district->name}}</td>
									<td class="text-center">{{$district->province->name}}</td>
									{{-- <td class="text-center">{{$district->slug}}</td> --}}
									<td class="text-center">
										<a href="{{route('admin.district.edit', ['district' => $district->id])}}" class="btn btn-warning" title="Cập nhật"><i class="fas fa-pencil-alt"></i></a>
										<a href="{{route('admin.district.destroy', ['district' => $district->id])}}" class="btn btn-danger btn-delete" data-page="district" title="Xóa"><i class="fa fa-trash"></i></a></td>
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
	$("#slProvinceId").select2();
</script>
@endsection
