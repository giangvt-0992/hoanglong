@extends('web.layout.master')
@section('content')
@include('web.layout.banner')
@include('web.layout.search')
<section class="countUpSection" style="background-image: url(web_template/Content/themes/startravel/img/home/promotion/promotion-3.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-6">
                <div class="text-center">
                    <div class="icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="counter">41</div>
                    <h5>{{ __('Destinations') }}</h5>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="text-center">
                    <div class="icon">
                        <i class="fa fa-bus" aria-hidden="true"></i>
                    </div>
                    <div class="counter">150</div>
                    <h5>{{ __('Trips') }}/{{ __('Day') }}</h5>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="text-center">
                    <div class="icon">
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                    </div>
                    <div class="counter">4526</div>
                    <h5>{{ __('Happy customers') }}</h5>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="text-center">
                    <div class="icon">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="counterCss">24/7</div>
                    <h5>{{ __('Support line') }}</h5>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js-lightHeader')
<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    function myFunction() {
        if (window.pageYOffset < 60) {
            navbar.classList.remove("lightHeader")
        } else {
            navbar.classList.add("lightHeader")
        }
    }
</script>
@endsection
