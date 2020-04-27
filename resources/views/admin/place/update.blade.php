@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<p>Home / Địa điểm / Sửa địa điểm</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Sửa địa điểm</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<div class="col-md-8 center-margin">
							<form class="form-horizontal form-label-left" method="POST" action="{{route('admin.place.update', ['place' => $place->id])}}">
								@csrf
								<div class="form-group">
									<label>Tên địa điểm</label>
									<input type="text" class="form-control" placeholder="Tên địa điểm" name="name" value="{{old('name', $place->name)}}" required>
									@if($errors->has('name'))
									<span class="text-danger">{{$errors->first('name')}}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Địa chỉ</label>
									<input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{old('address', $place->address)}}" required>
									@if($errors->has('address'))
									<span class="text-danger">{{$errors->first('address')}}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Map URL</label>
									<textarea type="text" class="form-control" placeholder="Link bản đồ" name="map" rows="5" required>{{old('map', $place->map_url)}}</textarea>
									@if($errors->has('map'))
									<span class="text-danger">{{$errors->first('map')}}</span>
									@endif
                </div>
                <div class="form-group">
									<label>Khu vực</label>
									<select name="districtId" class="form-control" id="districtId" required>
										<option value=""></option>
                    @foreach ($provinces as $province)
                    <optgroup label="{{$province->name}}">
                      @foreach ($province->districts as $district)
                      <option value="{{$district->id}}" @if($district->id === old('districtId', $place->district_id)) selected @endif>{{$district->name}}</option>
                      @endforeach
                    </optgroup>
										@endforeach
									</select>
									@if($errors->has('districtId'))
									<span class="text-danger">{{$errors->first('districtId')}}</span>
									@endif
								</div>
                <div class="form-group">
                  <label>Mô tả</label>
                  <textarea class="form-control" name="description" rows="5">{{old('description', $place->description)}}</textarea>
									@if($errors->has('description'))
									<span class="text-danger">{{$errors->first('description')}}</span>
									@endif
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.place.index')}}" >Hủy</button>
										<button type="submit" class="btn btn-success">Sửa</button>
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
  $("#districtId").select2();
</script>
@endsection
