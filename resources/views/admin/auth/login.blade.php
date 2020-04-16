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
    <link href="{{url('admin_template/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{route('admin.login')}}" method="POST">
                @csrf
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" name="email" value="{{old('email')}}" />
              </div>
              <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" value="{{old('password')}}" />
              </div>
              <div class="checkbox">
                <label class="">
                  <input type="checkbox" name="remember_me" id=""> Remember me
                </label>
              </div>
              @if (Session::has('status'))
                <div>
                    <p class="red">{{Session::get('status')}}</p>
                </div>
              @endif
              <div>
                <button class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
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
</html>
