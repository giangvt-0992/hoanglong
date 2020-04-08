@extends('web.layout.master')
@section('content')
@include('web.layout.banner')
<section class="darkSection">
    <div class="container">
        <div class="row gridResize">
            <form action="{{route('search')}}" method="post" id="form">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-sm-3 col-xs-12">
                    <div class="sectionTitleDouble">
                        <p>Choose</p>
                        <h2>your <br/><span>destination</span></h2>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="departure" name="departure">
                                    <option value="">{{__('Departure')}}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="destination" name="destination"><option value="">{{ __('Destination') }}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="input-group date ed-datepicker">
                                <input type="text" name="date" id="datebook" data-culture="vi" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" readonly="readonly" value="{{$nextdate}}">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select name="quantity" class="select2bootstrap" id="quantity">
                                    <option value="0">{{__('Quantity')}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <input type="hidden" id="hdculture" value="vi" />
                        <input type="hidden" name="step" value="step1">
                        <input type="submit" class="btn btn-block buttonCustomPrimary btnSearchShift" value="{{__('Search Route')}}" data-blank="1"/>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</section>
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
