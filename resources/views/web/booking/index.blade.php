@extends('web.layout.master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url('../web_template/Content/themes/startravel/img/pages/page-title-hcm.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1> {{ __('Reserve your ticket') }}</h1>
                            <div class="under-border"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="position: fixed; top: 0; width:100%; z-index: 1111; height: 100%; background-color: rgba(0,0,0,0.5); display:none;" id="pageLoading">
    <div style="position: absolute; top: 45%; left: 40%;" class="text-center">
        <i class="fa fa-spinner fa-spin" style="font-size:70px; color: wheat;"></i>
        <p style="font-size:20px; color: wheat;"> {{ __('Data is in processing') }} ...</p>
    </div>
 </div>
<?php 
    $step = 1;
    if (Session::has('step')) {
        $step = Session::get('step');
    }
    $locale = app()->getLocale();
?>
<section class="mainContentSection packagesSection boxbooking">
    <div class="container">
        <div class="row tabsPart">
            <div class="col-sm-12">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="oneway">
                            <div class="row progress-wizard hidden-xs" style="border-bottom:0;">
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-1 @if($step > config('constants.step.STEP1')) complete @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        1. {{__('Search route')}}
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step 
                                    @if($step < config('constants.step.STEP2'))
                                    {{'disabled'}}
                                    @elseif ($step == config('constants.step.STEP2'))
                                    {{'progress-step-2'}}
                                    @else
                                    {{'progress-step-2 complete'}}
                                    @endif
                                ">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        2. {{__('Enter your information')}}
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step 
                                    @if($step < config('constants.step.STEP3'))
                                    {{'disabled'}}
                                    @elseif ($step == config('constants.step.STEP3'))
                                    {{'progress-step-3'}}
                                    @else
                                    {{'progress-step-3 complete'}}
                                    @endif
                                ">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        3. {{__('Confirm your information')}}
                                    </a>
                                </div>

                                <div class="col-sm-3 col-xs-12 progress-wizard-step
                                    @if($step < config('constants.step.STEP4'))
                                    {{'disabled'}}
                                    @elseif ($step == config('constants.step.STEP4'))
                                    {{'progress-step-4'}}
                                    @else
                                    {{'progress-step-4 complete'}}
                                    @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        4. {{__("Booking Successfully")}}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="positiontop"></div>
                            <div class="step1 bookinghcm ">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="darkSection citiesPage">
                                            <div class="row gridResize">
                                                <div class="col-sm-3 col-xs-12">
                                                    <div class="sectionTitleDouble">
                                                        <p>{{ __("Book") }}</p>
                                                        <h2><span>{{ __("Ticket") }}</span></h2>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-xs-12">
                                                    <form action="{{route('booking', ['locale' => $locale])}}" method="get" id="form">
                                                        <?php 
                                                        $departure = Request::get('departure_id') ?? -1;
                                                        $quantity = Request::get('quantity') ?? 0;
                                                        $destination = Request::get('destination_id') ?? -1;
                                                        $date = Request::get('depart_date') ?? $nextdate;
                                                        $user = auth('web')->user();
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="departure" name="departure_id"><option value="" selected>{{__('Departure')}}</option>
                                                                        @foreach($provinces as $province)
                                                                        <option value="{{$province->id}}" @if($departure == $province->id) selected @endif>{{$province->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="destination" name="destination_id"><option value="">{{__('Destination')}}</option>
                                                                        @foreach($provinces as $province)
                                                                        <option value="{{$province->id}}" @if($destination == $province->id) selected @endif>{{$province->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="input-group date ed-datepicker">
                                                                    <input type="text" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" id="datebook" name="depart_date" readonly="readonly" value="{{$date}}">
                                                                    <div class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <input type="hidden" id="hddate" />
                                                                <input type="hidden" id="hdculture" value="vi" />
                                                                <input type="hidden" name="step" value="step1">
                                                                <input type="button" value="{{__('Search route')}}" class="btn buttonCustomPrimary btnSearchShift" data-blank="1" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select name="quantity" class="select2bootstrap" id="quantity">
                                                                        @for ($i = 1; $i < 6; $i++)
                                                                        <option value="{{$i}}" @if($quantity == $i) selected @endif>{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if( $step == config('constants.step.STEP1'))
                                <div class="row">
                                    <div class="col-sm-12  loadshifthcm">
                                        <div class="panel panel-default packagesFilter">
                                            <div class="panel-heading">
                                                <b>{{__('SEARCH RESULTS')}}</b>
                                            </div>
                                            <div class="note" style="padding:10px" id="note">
                                                ({{ __('Departure') }} <a target="_blank" href="javascript::void(0);">{{ $departProvince->name }}</a> {{__('to')}} <a target="_blank" href="">{{ $desProvince->name }}</a> {{__('Date')}} {{date('d-m-Y', strtotime($date)) }})
                                            </div>
                                            <div class="panel-body resultbooking">
                                                <div class="listshift">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                            <th class="hidden-xs hidden-sm">{{__('Brand')}}</th>
                                                            <th class="hidden-xs hidden-sm">{{__('Code trips')}}</th>
                                                                <th class="hidden-xs hidden-sm">{{__('Departure')}}</th>
                                                                <th>{{__('Start time')}}</th>
                                                                <th class="hidden-xs hidden-sm">{{__('Destination')}}</th>
                                                                <th class="hidden-xs hidden-sm">{{__('Arrival')}}</th>
                                                                <th class="hidden-xs hidden-sm">{{__('Time')}}</th>
                                                                <th>{{__('Seat')}}</th>
                                                                <th class="hidden-xs hidden-sm">{{__('Seat type')}}</th>
                                                                <th>{{__('Ticket prices')}}</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($routes as $route)
                                                            <tr>
                                                                <td class="hidden-xs hidden-sm">{{$route->brandName}}</td>
                                                                <td class="hidden-xs hidden-sm">{{$route->routeName}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$route->departName}}</b></td>
                                                                <td>{{$route->departTime}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$route->desName}}</b></td>
                                                                <td class="hidden-xs hidden-sm">{{$route->arriveTime}}</td>

                                                                <td class="hidden-xs hidden-sm">{{$route->duration}}</td>

                                                                <td><b>{{$route->availableSeats}}</b></td>
                                                                <td class="hidden-xs hidden-sm">{{$route->carType}}</td>
                                                                <td>{{number_format($route->price)}}</td>
                                                                <td>
                                                                    <a class="btn buttonTransparent btnSetVehicleId" 
                                                                    >Đặt vé</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- @if($locale == config('app.support_language.vietnam')) --}}
                                                <div class="bottombooking">
                                                    <div>
                                                        <u>{{ __('Note') }}:</u><br>
                                                        + <b>{{ __('Departure') }}:</b> {{ __('is your departure point') }}.<br>
                                                        + <b>{{__('Start time')}}:</b> {{ __('is the scheduled departure time of the day') }}.<br>
                                                        + <b>{{ __('Destination') }}:</b> {{ __('is your destination point') }}.<br>
                                                        + <b>{{__('Arrival')}}:</b> {{ __('is the scheduled time you will arrive at the destination') }}.<br>
                                                        + <b>{{__('Time')}}:</b> {{ __('is the total estimated travel time of the vehicle') }}.<br>
                                                        + <b>{{__('Seat')}}:</b> {{ __('is the number of available seats on the bus') }}.<br>
                                                        + <b>{{__('Ticket prices')}}:</b> {{ __('the amount you pay to ride on the chosen itinerary') }}.<br>
                                                    </div>
                                                    <br>
                                                </div>
                                                {{-- @endif --}}
                                            </div>
                                        </div><!--end panel-default-->
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end class step1-->

                            <!--end step2-->

                            <!--end step3-->

                            <!--end step4-->
                            <hr />

                        </div>
                        <div role="tabpanel" class="tab-pane" id="roundtrip"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- booking --}}

        {{-- <div class="whiteSection">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="sectionTitle">
                        <h2><span>H&#236;nh ảnh giường nằm</span></h2>
                    </div>
                    <img style="width: 90%;" src="public/source/Images/hoanglonggiuong.jpg" title="Hinh anh xe Hoang Long" alt="Hinh anh xe Hoang Long" />
                </div>
            </div>
        </div> --}}
    </div><!--end div container-->

</section>
@endsection
@section('js-lightHeader')
{{-- <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/vendor/jquery/jquery.js')}}"></script> --}}


@endsection
@section('after-scripts')
<script src="{{ url('web_template/js/booking.js')}}"></script>
@endsection