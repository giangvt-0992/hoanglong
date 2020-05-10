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
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content" style="padding: 0;">
            <form action="{{route('admin.login')}}" method="POST" id="frmLogin">
              @csrf
              <h1>Đăng nhập</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" name="email" value="{{old('email')}}" />
              </div>
              <div>
              <input type="password" class="form-control" placeholder="Mật khẩu" required="" name="password" value="{{old('password')}}" />
              </div>
              <div class="checkbox">
                <label class="">
                  <input type="checkbox" name="remember_me" id=""> Ghi nhớ đăng nhập
                </label>
              </div>
              @if (Session::has('status'))
                <div>
                    <p class="red">{{Session::get('status')}}</p>
                </div>
              @endif
              @if (Session::has('success'))
              <div>
                <p class="green">{{Session::get('success')}}</p>
              </div>
              @endif
              <div>
                <button class="btn btn-default submit">Đăng nhập</button>
                <a class="reset_pass" href="#" id="reset_pass">Quên mật khẩu?</a>
              </div>
              <div class="clearfix"></div>
              {{-- <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div> --}}
            </form>
            <form action="{{route('admin.password.sendmail')}}" method="POST" style="display: none;" id="frmResetPassword">
              @csrf
              <h1>Reset Password</h1>
              <div>
                <input type="text" class="form-control" placeholder="Enter your Email" required="" name="email" value="" />
              </div>
              <p>Một mail sẽ được gửi vào email của bạn. Vui lòng click vào đường dẫn để tiếp tục quá trình đổi mật khẩu</p>
              <div>
                <button class="btn btn-default submit">Gửi mail</button>
                <a class="reset_pass login" href="#" id="btnLogin">Đăng nhập với tài khoản của bạn?</a>
              </div>
            </form>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </body>
  <script src="{{url('admin_template/js/jquery.min.js')}}"></script>
  <script>
    $('#reset_pass').click(function() {
      // $('')
      $('#frmLogin').slideUp();
      $('#frmResetPassword').show();
      $('#frmResetPassword').slideDown();
    });

    $('#btnLogin').click( function () {
      $('#frmLogin').slideDown();
      $('#frmResetPassword').slideUp();
    })
  </script>
</html>
