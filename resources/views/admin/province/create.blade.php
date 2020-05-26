@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
    @include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Thêm tình thành</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Thêm tỉnh thành</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.province.store')}}">
                @csrf
                <div class="form-group">
                  <label>Tên tỉnh thành</label>
                  <input type="text" class="form-control" placeholder="Tên tỉnh thành" name="name" value="{{old('name')}}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.province.index')}}" >Hủy</button>
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
