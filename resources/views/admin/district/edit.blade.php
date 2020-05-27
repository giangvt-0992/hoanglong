@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
    @include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Cập nhật quận huyện</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Cập nhật quận huyện</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.district.update', ['district' => $district->id])}}">
                @csrf
                <div class="form-group">
                  <label>Tên tỉnh thành</label>
                  <select name="province_id" id="slProvinceId" class="form-control select2">
                    <option value="">Chọn tỉnh thành</option>
                    @foreach ($provinces as $province)
                    <option value="{{$province->id}}" @if($province->id == old('province_id', $district->province->id)) selected @endif>{{$province->name}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Tên quận huyện</label>
                  <input type="text" class="form-control" placeholder="Tên quận huyện" name="name" value="{{old('name', $district->name)}}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                    <button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.district.index')}}" >Hủy</button>
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
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script>
  // const axios = require('axios');
  $("#slProvinceId").select2();
</script>
@endsection