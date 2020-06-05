@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
    @include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Đổi mật khẩu</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Đổi mật khẩu</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.profile.change_password')}}" id="frmChangePassword">
                @csrf
                <div class="form-group">
                  <label>Mật khẩu cũ</label>
                  <input type="password" class="form-control" name="old_password" value="">
                  @if($errors->has('old_password'))
                  <span class="text-danger">{{$errors->first('old_password')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Mật khẩu mới</label>
                  <input type="password" class="form-control" name="new_password" value="">
                  @if($errors->has('new_password'))
                  <span class="text-danger">{{$errors->first('new_password')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Xác nhận mật khẩu</label>
                  <input type="password" class="form-control" name="new_password_confirmation" value="">
                  @if($errors->has('new_password_confirmation'))
                  <span class="text-danger">{{$errors->first('new_password_confirmation')}}</span>
                  @endif
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success btn-change-password">Đổi mật khẩu</button>
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
@section('after-scripts')
<script>
  $(".btn-change-password").click(function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Xác nhận đổi mật khẩu?',
      text: "Sau khi đổi mật khẩu thành công, bạn sẽ cần phải đăng nhập lại!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Đổi mật khẩu!'
    }).then((result) => {
      if (result.value == true) {
        $("#frmChangePassword").submit();
      }
    });
  });
</script>
@endsection
