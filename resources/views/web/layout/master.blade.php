<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script> --}}
    
    
    <link href="{{ url('web_template/Content/jqueryui-1.12.1-blitzer/jquery-ui.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/jqueryui-1.12.1-blitzer/jquery-ui.structure.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/jqueryui-1.12.1-blitzer/jquery-ui.theme.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/rs-plugin/css/settings.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/selectbox/select_option1.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/datepicker/datepicker.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/isotope/jquery.fancybox.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/plugins/isotope/isotope.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/css/style.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/themes/startravel/css/colors/purple.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/bootstrap-responsive.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Scripts/plugin/sweetalert/sweet-alert.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Scripts/plugin/niceselect/css/nice-select.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Scripts/plugin/select2/css/select2.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/custom.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/style.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/ss.css')}}" rel="stylesheet"/>
    <link href="{{ url('web_template/Content/responsive.css')}}" rel="stylesheet"/>
    {{-- <script src="{{ url('js/myscript.js') }}"></script> --}}
    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- <script src='../www.google.com/recaptcha/api.js'></script> -->
    @yield('head-content')
</head>
<body>
    @include('web.layout.header')
    @yield('content')
    @include('web.layout.footer')
    <script src="{{ url('web_template/Scripts/jquery-1.9.1.min.js')}}"></script>
    
    <script src="{{ url('web_template/Content/jqueryui-1.12.1-blitzer/jquery-ui.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/selectbox/jquery.selectbox-0.1.3.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/counter-up/jquery.counterup.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/isotope/isotope.min.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/isotope/jquery.fancybox.pack.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/isotope/isotope-triger.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/countdown/jquery.syotimer.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/plugins/smoothscroll/SmoothScroll.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/jquery.blockui.min.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/countdowntimer/jquery.countdown.min.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/niceselect/js/jquery.nice-select.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/select2/js/select2.js')}}"></script>
    <script src="{{ url('web_template/Content/themes/startravel/js/custom.js')}}"></script>
    <script src="{{ url('web_template/Scripts/plugin/amlich.js')}}"></script>
    
    <script src="{{ url('web_template/Scripts/core.js')}}"></script>
    
    <script src="{{ url('web_template/Scripts/custom.js')}}"></script>
    <script src="{{ url('web_template/Scripts/price.js')}}"></script>
    <script src="{{ url('web_template/Scripts/library.js')}}"></script>
    <script src="{{ url('web_template/Scripts/shortshift.js')}}"></script>
    <script src="{{ url('web_template/Scripts/limousine.js')}}"></script>
    <script src="{{ url('web_template/Scripts/home.js')}}"></script>
    <script src="{{ url('web_template/Scripts/contact.js')}}"></script>
    <script src="{{ url('web_template/Scripts/booking.js')}}"></script>
    <script src="{{ url('web_template/Scripts/bookingcatba.js')}}"></script>
    <script src="{{ url('web_template/Scripts/service.js')}}"></script>
    <script src="{{ url('web_template/Scripts/about.js')}}"></script>
    <script src="{{ url('web_template/Scripts/functions.js')}}"></script>
    <script src="{{ url('web_template/Scripts/app.js')}}"></script>
    <script src="{{ url('web_template/Scripts/application.js')}}"></script>
    @yield('js-lightHeader')
    @yield('after-scripts')
</body>
</html>
