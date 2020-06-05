@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
    @include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Thông tin cá nhân</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Thông tin tài khoản</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.profile.update')}}">
                @csrf
                <div class="form-group">
                  <label>Tên người dùng</label>
                  <input type="text" class="form-control" placeholder="Tên người dùng" name="name" value="{{old('name', $admin->name)}}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="{{$admin->email}}" readonly>
                </div>
                <div class="form-group">
                  <label>Vai trò</label>
                  <input type="text" class="form-control" placeholder="Vai trò" name="role" value="{{$admin->role->name}}" readonly>
                </div>
                <div class="form-group">
                  <label>Nhà xe</label>
                  <input type="text" class="form-control" placeholder="Nhà xe" name="brand" value="{{$admin->brand->name}}" readonly>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
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
