<header>
    <nav class="navbar navbar-default navbar-main navbar-fixed-top @yield('class-header')" id = "navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('index', app()->getLocale())}}">
                    <img src="{{url('web_template/Images/logo_xe2.png')}}" alt="logo-hl" width="235">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php $current_route = Route::getCurrentRoute()->getName(); ?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="@if(isActiveRoute('index')) active @endif">
                        <a href="{{route('index', app()->getLocale())}}">{{__('Home')}}</a>
                    </li>
                    <li class="@if(isActiveRoute('booking')) active @endif">
                        <a href="{{route('booking', app()->getLocale())}}"> {{__('Booking Ticket')}} </a>
                    </li>
                    <li class="@if(isActiveRoute('price-table')) active @endif">
                        <a href="{{ route('price-table', app()->getLocale())}}"> {{__('Price')}} </a>
                    </li>
                    <li class="@if(isActiveRoute('ticket-purchase-guide')) active @endif">
                        <a href="{{route('ticket-purchase-guide', app()->getLocale())}}">{{__('Ticket purchase guide')}}</a>
                    </li>
                    <?php $user = auth('web')->user(); ?>
                    @if(isset($user))
                    <li>
                        {{-- <li>
                            <a href="{{route('guess-logout')}}">Đăng xuất</a>
                        </li> --}}
                        <img src="{{$user->picture}}" alt="" style="margin-top:20px; width: 50px; heigh: 50px; border-radius: 50%;">
                        
                    </li>
                    @else
                    <li class="img-link">                                
                        <a href="{{route('social-redirect', 'google')}}" target="_blank"><img src="{{ url('web_template/Images/google.png') }}" class="icon" height="15" /></a>
                    </li>
                    @endif
                    <li>
                        @if (app()->getLocale() === config('app.support_language.english')) 
                        <a href="{{route('change-language', ['language' => 'vi'])}}"><img src="{{url('web_template/Images/icon/icon-vn.png')}}" class="icon icon-vn" width="23" height="15" data-returnurl=""></a>
                        @else
                        <a href="{{route('change-language', 'en')}}"><img src="{{url('web_template/Images/icon/icon-uk.png')}}" class="icon icon-uk" width="23" height="15" data-returnurl=""></a>
                        @endif
                    </li>
                    {{-- <li>
                        <a href="{{route('change-language', 'en')}}" style="margin-left: 0;"><img src="{{url('web_template/Images/icon/icon-uk.png')}}" class="icon icon-uk" width="23" height="15" data-returnurl=""></a>
                    </li> --}}
                </ul>
            </div>
            
            <div class="language-mobile hidden-md hidden-lg hidden-sm" style="right: 30px">
                <a href="javascript:;">
                    <a href="https://www.facebook.com/giang.tuan.58" target="_blank"><img src="web_template/Images/fb.png" class="icon" height="27" style="width: 27px" />
                    </a>
                </div>
            </div>
        </nav>
    </header>
