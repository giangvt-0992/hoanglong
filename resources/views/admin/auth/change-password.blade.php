<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <link href="{{url('admin_template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/css/all.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
<div>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form  action="{{route('admin.password.reset')}}" method="POST">
          @csrf
          <h1>Đổi mật khẩu</h1>
          <input type="hidden" name="token" value="{{$token}}">
          <div>
            <input type="password" class="form-control" placeholder="Mật khẩu mới" required="" name="password" value="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Xác nhận mật khẩu mới" required="" name="password_confirmation" value="" />
          </div>
          @if($errors->has('password'))
          <div>
            <span class="text-danger">{{$errors->first('password')}}</span>
          </div>
          @endif
          <div>
            <button class="btn btn-default submit">Xác nhận</button>
          </div>
          <div class="clearfix"></div>
          <div class="separator">            
            <div class="clearfix"></div>
            <br />
            
            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
</body>
<script src="{{url('admin_template/js/jquery.min.js')}}"></script>
<script>
  $('#reset_pass').click(function() {
    // $('')
    $('#frmResetPassword').show();
  });
</script>
</html>