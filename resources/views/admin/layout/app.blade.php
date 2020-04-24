<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{url('admin_template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('admin_template/css/nprogress.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/vendors/iCheck/skins/flat/blue.css')}}" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="{{url('admin_template/css/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"/>

    <link href="{{url('admin_template/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{url('admin_template/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet"/>

    <link href="{{url('admin_template/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet"/>
    <link href="{{url('admin_template//vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{url('admin_template/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{url('admin_template/css/my-styles.css')}}" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('admin.layout.left_sidebar')
        <!-- top navigation -->
        @include('admin.layout.top_nav')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        @include('admin.layout.footer')
        <!-- /footer content -->
      </div>
    </div>

    @yield('before-scripts')
    <!-- jQuery -->
    <script src="{{url('admin_template/js/jquery.min.js')}}"></script>
    <script src="{{url('admin_template/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{url('admin_template/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('admin_template/js/nprogress.js')}}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{url('admin_template/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{url('admin_template/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin_template/js/dataTables.bootstrap.min.js')}}"></script>
    
    <script src="{{url('admin_template/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{url('admin_template/js/sweetalert2@9.js')}}"></script>
    <script src="{{url('admin_template/vendors/pnotify/dist/pnotify.js')}}"></script>
    <script src="{{url('admin_template/vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script src="{{url('admin_template/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{url('admin_template/js/custom.min.js')}}"></script>
    <script src="{{url('admin_template/js/dropzone-config.js')}}"></script>
    <script src="{{url('admin_template/js/my-scripts.js')}}"></script>
    @yield('after-scripts')
  </body>
</html>
