@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Tình thành</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-bars"></i> Danh sách Tình thành</h2>
						<a href="{{route('admin.province.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm Tình thành</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered" id="datatable">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th class="text-center">Tên</th>
									{{-- <th class="text-center">Slug</th> --}}
									<th class="text-center">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($provinces as $province)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="text-center">{{$province->name}}</td>
									{{-- <td class="text-center">{{$province->slug}}</td> --}}
									<td class="text-center">
										<a href="{{route('admin.province.edit', ['province' => $province->id])}}" class="btn btn-warning" title="Cập nhật"><i class="fas fa-pencil-alt"></i></a>
										<a href="{{route('admin.province.destroy', ['province' => $province->id])}}" class="btn btn-danger btn-delete" data-page="province" title="Xóa"><i class="fa fa-trash"></i></a></td>
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
