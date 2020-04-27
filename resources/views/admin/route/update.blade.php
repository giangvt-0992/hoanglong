@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Tuyến đường / Thêm tuyến đường</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Thêm tuyến đường</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<div class="col-md-8 center-margin">
							<form class="form-horizontal form-label-left" method="POST" action="{{route('admin.route.update', [
								'route' => $route->id
							])}}">
								@csrf
								<div class="form-group">
									<label>Tên tuyến đường</label>
									<input type="text" class="form-control" placeholder="Tên tuyến đường" name="name" value="{{old('name', $route->name)}}" required>
									@if($errors->has('name'))
									<span class="text-danger">{{$errors->first('name')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pl-0">
									<label>Điểm đi</label>
									<select name="departPlaceId" class="form-control" id="departPlaceId" required>
										<option value=""></option>
										@foreach ($places as $place)
										<option value="{{$place->id}}" @if($place->id == old('departPlaceId', $route->depart_place_id)) selected @endif>{{$place->name}}</option>
										@endforeach
									</select>
									@if($errors->has('departPlaceId'))
									<span class="text-danger">{{$errors->first('departPlaceId')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Điểm đến</label>
									<select name="desPlaceId" class="form-control" id="desPlaceId" required>
										<option value=""></option>
										@foreach ($places as $place)
										<option value="{{$place->id}}" @if($place->id == old('desPlaceId', $route->des_place_id)) selected @endif>{{$place->name}}</option>
										@endforeach
									</select>
									@if($errors->has('desPlaceId'))
									<span class="text-danger">{{$errors->first('desPlaceId')}}</span>
									@endif
								</div>
								<div class="form-group form-group col-md-6 pl-0">
									<label>Giờ</label>
									<input type="number" class="form-control" placeholder="Giờ" name="hours" value="{{old('hours', $route->duration->hours)}}" min="0" required />
									@if($errors->has('hours'))
									<span class="text-danger">{{$errors->first('hours')}}</span>
									@endif
								</div>
								<div class="form-group form-group col-md-6 pr-0">
									<label>Phút</label>
									<input type="number" class="form-control" placeholder="Phút" name="minutes" value="{{old('minutes', $route->duration->minutes)}}" min="0" max="59" required />
									@if($errors->has('minutes'))
									<span class="text-danger">{{$errors->first('minutes')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pl-0">
									<label>Khoảng cách (Km)</label>
									<input type="text" class="form-control number-format" placeholder="Khoảng cách" name="distance" value="{{old('distance', $route->distance)}}" required>
									@if($errors->has('distance'))
									<span class="text-danger">{{$errors->first('distance')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Giá tiền</label>
									<input type="text" class="form-control number-format" placeholder="Giá tiền" name="price" value="{{old('price', $route->price)}}" min="0" required>
									@if($errors->has('price'))
									<span class="text-danger">{{$errors->first('price')}}</span>
									@endif
								</div>
								<div class="clear"></div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-warning">Cập nhật</button>
										<button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.route.index')}}" >Hủy</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('after-scripts')
<script>
	$("#departPlaceId").select2();
	$("#desPlaceId").select2();
</script>
@endsection
