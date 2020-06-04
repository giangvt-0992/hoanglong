@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<p>Home / Nhà xe / Cập nhật nhà xe</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Cập nhật nhà xe</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<div class="col-md-8 center-margin">
						<form id="form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('admin.brand.update', ['brand' => $brand->id])}}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="_method" value="put">
							<div class="form-group">
								<label for="name">Tên nhà xe 
								</label>
								<input type="text" name="name" required="required" class="form-control" value="{{old('name', $brand->name)}}">
								@if($errors->has('name'))
								<span class="text-danger">{{$errors->first('name')}}</span>
								@endif
							</div>
							<div class="form-group" style="margin-bottom: 0;">
								<label for="phones" >Số điện thoại</label>
								<div class="row">
								@php 
								$phones = json_decode($brand->phone) ?? null;
								$oldPhone = old('phones') ?? $phones;
								@endphp
								@if(isset($oldPhone))
									@foreach ($oldPhone as $phone)
									@if($loop->index == 0)
									<div class="col-md-11 col-sm-11 col-xs-12" style="margin-bottom: 10px;">
									<input id="phones" class="form-control" type="text" name="phones[]" value="{{$phone}}">
									</div>
									<div class="col-md-1 com-sm-1 col-xs-2">
										<button class="btn btn-success btnAddInput" data-input-name="phones[]"><i class="fa fa-plus"></i></button>
									</div>
									@else
									<div class="wrapper-input">
										<div class="col-md-11 col-sm-11 col-xs-12" style="margin-bottom: 10px;">
											<input id="middle-name" class="form-control" type="text" name="phones[]" value="{{$phone}}">
										</div>
										<div class="col-md-1 com-sm-1 col-xs-2">
											<button class="btn btn-danger btnRemoveInput" onClick="removeInput(this)"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									@endif
									@endforeach
								@else
								<div class="col-md-11 col-sm-11 col-xs-12 form-group" style="margin-bottom: 10px;">
									<input id="middle-name" class="form-control" type="text" name="phones[]">
								</div>
								<div class="col-md-1 com-sm-1 col-xs-2">
									<button class="btn btn-success btnAddInput" data-input-name="phones[]"><i class="fa fa-plus"></i></button>
								</div>
								@endif
								@if($errors->has('phones.*'))
								<div class="col-md-12 col-sm-12 col-xs-12">
									<span class="text-danger">{{$errors->first('phones.*')}}</span>
								</div>
								@endif
							</div>
							</div>
							<div class="form-group" style="margin-bottom: 0;">
								<label >Ngân hàng 
								</label>
								<div class="row">
								<?php 
								$bank = json_decode($brand->bank) ?? null;
								$oldBank = old('banks', $bank); 
								?>
								@if(isset($oldBank))
									@foreach ($oldBank as $bank)
									@if($loop->index == 0)
									<div class="<col-md-11 col-sm-11 col-xs-12 form-group">
										<input class="form-control" required="required" type="text" name="banks[]" value="{{$bank}}">
									</div>
									<div class="col-md-1 com-sm-1 col-xs-2 btn-add">
										<button class="btn btn-success fr btnAddInput" data-input-name="banks[]"><i class="fa fa-plus"></i></button>
									</div>
									@else
									<div class="wrapper-input">
										<div class="<col-md-11 col-sm-11 col-xs-11" style="margin-bottom: 10px;">
											<input class="form-control" required="required" type="text" name="banks[]" value="{{$bank}}">
										</div>
										<div class="col-md-1 com-sm-1 col-xs-2">
											<button class="btn btn-danger btnRemoveInput"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									@endif
									@endforeach
								@else
								<div class="<col-md-11 col-sm-11 col-xs-11">
									<input class="date-picker form-control col-md-7 col-xs-12 form-group" required="required" type="text" name="banks[]">
								</div>
								<div class="col-md-1 com-sm-1 col-xs-2 btn-add">
									<button class="btn btn-success fr btnAddInput" data-input-name="banks[]"><i class="fa fa-plus"></i></button>
								</div>
								@endif
								@if($errors->has('banks.*'))
								<div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<span class="text-danger">{{$errors->first('banks.*')}}</span>
								</div>
								@endif
							</div>
							</div>
							<div class="form-group">
								<label for="description" >Mô tả</label>
								<div class="row">
								<div class="<col-md-12 col-sm-12 col-xs-12">
									<textarea class="form-control" rows="5" name="description">{{old('description', $brand->description)}}</textarea>
								</div>
								@if($errors->has('banks'))
								<div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<span class="text-danger">{{$errors->first('description')}}</span>
								</div>
								@endif
								</div>
							</div>
							<div class="form-group">
								<label  for="notice">Lưu ý</label>
								<div class="row">
								<div class="<col-md-12 col-sm-12 col-xs-12">
									<textarea class="form-control" rows="5" name="notice">{{old('notice', $brand->notice)}}</textarea>
								</div>
								@if($errors->has('notice'))
								<div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<span class="text-danger">{{$errors->first('notice')}}</span>
								</div>
								@endif
								</div>
							</div>
							<div class="form-group">
								<label  for="mainImage">Ảnh</label>
								<div class="<col-md-12 col-sm-12 col-xs-12" style="padding-top: 8px">
									<input type="file" id="image" name="mainImage" accept="image/*">
									<img id="previewImage" src="{{url($brand->image)}}" alt="your image" style="max-width: 100%; margin-top: 10px;"/>
								</div>
								@if($errors->has('mainImage'))
								<div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<span class="text-danger">{{$errors->first('mainImage')}}</span>
								</div>
								@endif
							</div>
							<div class="form-group">
								<div class="dropzone col-xs-12" id="my-dropzone" name="myDropzone"  route-upload="{{route('admin.image.upload')}}" route-get-images="{{route('admin.brand.images', ['id' => $brand->id])}}">
									<div class="dz-message" data-dz-message><span>Kéo ảnh hoặc chọn vào đây để thêm bộ sưu tập</span></div>
									
								</div>
								@if($errors->has('image.*'))
								{{-- <div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3"> --}}
									<span class="text-danger">{{$errors->first('image.*')}}</span>
								{{-- </div> --}}
								@endif
							</div>
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="<col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Cập nhật</button>
									<button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.brand.index')}}">Hủy</button>
								</div>
							</div>
						</form>
					</div>
					</div>
				</>
			</div>
		</div>
	</div>
</div>
@endsection

@section('after-scripts')
<script>
	$(".btnRemoveInput").bind("click", function() {
		e.preventDefault();
    alert('a');
});
</script>
@endsection