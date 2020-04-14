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
    $user = auth('web')->user();
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
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-2
                                @if($step < config('constants.step.STEP2'))
                                {{'disabled'}}
                                @else
                                {{'complete'}}
                                @endif
                                ">
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="javascript:void(0)" class="progress-wizard-dot">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                    2. {{__('Enter your information')}}
                                </a>
                            </div>
                            <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-3
                            @if($step < config('constants.step.STEP3'))
                            {{'disabled'}}
                            @else
                            {{'complete'}}
                            @endif
                            ">
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="progress-wizard-dot">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                3. {{__('Confirm your information')}}
                            </a>
                        </div>
                        
                        <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-4 
                        @if($step < config('constants.step.STEP4'))
                        {{'disabled'}}
                        @else
                        {{'complete'}}
                        @endif">
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="javascript:void(0)" class="progress-wizard-dot">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            4. {{__("Booking Successfully")}}
                        </a>
                    </div>
                </div>
                
                <div class="positiontop"></div>
                @include('web.booking.step1', [
                    'locale' => $locale
                ])
                <!--end class step1-->
                @include('web.booking.step2', [
                    'user' => $user
                ])
                <!--end step2-->
                @include('web.booking.step3')
                <!--end step3-->
                <div id="step4render">
                    
                </div>
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
                <h2><span>Chi tiết</span></h2>
            </div>
            
        </div>
    </div>
</div> --}}
</div>

</section>
@endsection
@section('js-lightHeader')
{{-- <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/vendor/jquery/jquery.js')}}"></script> --}}


@endsection
@section('after-scripts')
<script src="{{ url('web_template/custom/booking.js')}}"></script>
@endsection