@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<p>Home / Người dùng và phân quyền / Sửa người dùng</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Sửa người dùng</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.user.store')}}">
                @csrf
                <div class="form-group">
                  <label>Tên người dùng</label>
                  <input type="text" class="form-control" placeholder="Tên người dùng" name="name" value="{{old('name')}}" required>
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required readonly>
                  @if($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Mật khẩu</label>
                  <input type="password" class="form-control" placeholder="" name="password" value="">
                  @if($errors->has('password'))
                  <span class="text-danger">{{$errors->first('password')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Xác nhận mật khẩu</label>
                  <input type="password" class="form-control" placeholder="" name="rePassword" value="">
                  @if($errors->has('rePassword'))
                  <span class="text-danger">{{$errors->first('rePassword')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Hãng xe</label>
                  <select name="brandId" class="form-control" id="">
                    <option value=""></option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}" @if($brand->id === old('brandId')) selected @endif>{{$brand->name}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('brandId'))
                  <span class="text-danger">{{$errors->first('brandId')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Quyền</label>
                  <select name="roleId" class="form-control" id="">
                    <option value=""></option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}" @if($role->id === old('roleId')) selected @endif>{{$role->name}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('roleId'))
                  <span class="text-danger">{{$errors->first('roleId')}}</span>
                  @endif
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.user.index', ['tab' => 'user'])}}" >Hủy</button>
                    <button type="submit" class="btn btn-success">Thêm</button>
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
