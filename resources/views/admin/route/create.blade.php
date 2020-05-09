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
							<form class="form-horizontal form-label-left" method="POST" action="{{route('admin.route.store')}}">
								@csrf
								<div class="form-group col-md-6 pl-0">
									<label>Thành phố</label>
									<select name="departProvinceId" class="form-control" id="departProvinceId" data-route-get-places="{{route('admin.province.places')}}" required>
										<option value="">Thành phố đi</option>
										@foreach ($provinces as $province)
										<option 
										value="{{$province->id}}"
										@if ($province->id == old('departProvinceId')) selected @endif
										>{{$province->name}}</option>
										@endforeach
									</select>
									@if($errors->has('departPlaceId'))
									<span class="text-danger">{{$errors->first('departPlaceId')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Điểm đi</label>
									<select name="departPlaceId" class="form-control" id="departPlaceId" required>
										{{-- <option value=""></option> --}}
										@foreach ($oldDepartProvincePlaces as $place)
										<option 
										value="{{$place->id}}"
										@if ($place->id == old('departPlaceId')) @endif
										>{{$place->name}}</option>
										@endforeach
									</select>
									@if($errors->has('departPlaceId'))
									<span class="text-danger">{{$errors->first('departPlaceId')}}</span>
									@endif
								</div>

								<div class="form-group col-md-6 pl-0">
									<label>Thành phố</label>
									<select name="desProvinceId" class="form-control" id="desProvinceId" data-route-get-places="{{route('admin.province.places')}}" required>
										<option value="">Thành phố đến</option>
										@foreach ($provinces as $province)
										<option 
										value="{{$province->id}}"
										@if ($province->id == old('desProvinceId')) selected @endif
										>{{$province->name}}</option>
										@endforeach
									</select>
									@if($errors->has('desProvinceId'))
									<span class="text-danger">{{$errors->first('desProvinceId')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Điểm đến</label>
									<select name="desPlaceId" class="form-control" id="desPlaceId" required>
										{{-- <option value=""></option> --}}
										@foreach ($oldDesProvincePlaces as $place)
										<option 
										value="{{$place->id}}"
										@if ($place->id == old('desPlaceId')) @endif
										>{{$place->name}}</option>
										@endforeach
									</select>
									@if($errors->has('desPlaceId'))
									<span class="text-danger">{{$errors->first('desPlaceId')}}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Tên tuyến đường</label>
									<input type="text" class="form-control" placeholder="Tên tuyến đường" name="name" value="{{old('name')}}" id="routeName" required>
									@if($errors->has('name'))
									<span class="text-danger">{{$errors->first('name')}}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Các điểm đón khách</label>
									<select name="listPassingPlaceId[]" class="form-control" id="listPassingPlaceId" multiple="multiple" required>
										<option value=""></option>
										@foreach ($places as $place)
										<option 
										value="{{$place->id}}"
										@if(in_array($place->id, old('listPassingPlaceId', []))) selected @endif
										data-province="{{$place->district->province->name}}"
										>{{$place->name}}</option>
										@endforeach
									</select>
									@if($errors->has('listPassingPlaceId'))
									<span class="text-danger">{{$errors->first('listPassingPlaceId')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pl-0">
									<label>Giờ</label>
									<input type="number" class="form-control" placeholder="Giờ" name="hours" value="{{old('hours')}}" min="0" required />
									@if($errors->has('hours'))
									<span class="text-danger">{{$errors->first('hours')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Phút</label>
									<input type="number" class="form-control" placeholder="Phút" name="minutes" value="{{old('minutes')}}" min="0" max="59" required />
									@if($errors->has('minutes'))
									<span class="text-danger">{{$errors->first('minutes')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pl-0">
									<label>Khoảng cách (Km)</label>
									<input type="text" class="form-control number-format" placeholder="Khoảng cách" name="distance" value="{{old('distance')}}" required>
									@if($errors->has('distance'))
									<span class="text-danger">{{$errors->first('distance')}}</span>
									@endif
								</div>
								<div class="form-group col-md-6 pr-0">
									<label>Giá tiền</label>
									<input type="text" class="form-control number-format" placeholder="Giá tiền" name="price" value="{{old('price')}}" min="0" required>
									@if($errors->has('price'))
									<span class="text-danger">{{$errors->first('price')}}</span>
									@endif
								</div>
								<div class="clear"></div>
								<div class="form-group">
									<label for="">Mô tả</label>
									<textarea class="form-control" name="description" id="" rows="5">{{old('description')}}</textarea>
									@if($errors->has('description'))
									<span class="text-danger">{{$errors->first('description')}}</span>
									@endif
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success">Thêm</button>
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
	$("#listPassingPlaceId").select2();
	$("#desProvinceId").select2();
	$("#departProvinceId").select2();

	$("#departProvinceId").change(function () {
		$("#departPlaceId").empty();
		if ($(this).val()) {
			$.ajax({
				type: "POST",
				url: $(this).attr('data-route-get-places'),
				data: {
					provinceId: $(this).val()
				},
				success: function(response) {
					if (response.status === 200) {
						const data = response.data;
						for (const item of data) {
							$("#departPlaceId").append(`<option value="${item.id}">${item.name}</option>`);
						}
						createRouteName();
					}
				},
				error: function (error) {
				}
			});
		} else {
			createRouteName();
		}
	})

	$("#desProvinceId").change(function () {
		if ($(this).val()) {
			$.ajax({
				type: "POST",
				url: $(this).attr('data-route-get-places'),
				data: {
					provinceId: $(this).val()
				},
				success: function(response) {
					if (response.status === 200) {
						$("#desPlaceId").empty();
						const data = response.data;
						for (const item of data) {
							$("#desPlaceId").append(`<option value="${item.id}">${item.name}</option>`);
						}
						createRouteName();
					}
				},
				error: function (error) {
				}
			});
		} else {
			createRouteName();
		}
	})

	function createRouteName() {
		const departPlaceId = $("#departPlaceId").val();
		const desPlaceId = $("#desPlaceId").val();
		if (desPlaceId && departPlaceId) {
			if (departPlaceId === desPlaceId) {
				new PNotify({
						title: "Tuyến đường không hợp lệ",
						text: `Điểm đi và điểm đến không được trùng nhau`,
						type: "error",
						styling: "bootstrap3"
					});
					$("#routeName").val('');
			} else {
				const departPlaceName = $("#departPlaceId option:selected").text();
				const departProvinceName = $("#departProvinceId option:selected").text();
				const desPlaceName = $("#desPlaceId option:selected").text();
				const desProvinceName = $("#desProvinceId option:selected").text();
				const routeName = `Tuyến ${departProvinceName} - ${desProvinceName} (${departPlaceName} - ${desPlaceName})`;

				$("#routeName").val(routeName);
			}
		} else {
			$("#routeName").val('');
		}
	}

	$("#departPlaceId").change(function () {
		createRouteName();
	});

	$("#desPlaceId").change(function () {
		createRouteName();
	});
</script>
@endsection
