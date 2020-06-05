<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{url('admin_template/images/img.jpg')}}" alt="">{{auth('admin')->user()->name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{route('admin.profile.index')}}"> Thông tin</a></li>
                        <li><a href="{{route('admin.profile.change_password')}}"> Đổi mật khẩu</a></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a></li>
                    </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge bg-green">{{count($notifications->where('read_at', ''))}}</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <div style="max-height: 250px; overflow-y: scroll;" id="notiWrapper">
                            @foreach ($notifications as $notification)
                            <li class="@if($notification->read_at) as-read @endif">
                                <a href="{{route('admin.ticket.show', ['code' => $notification->data['code'], 'notify_id' => $notification->id])}}">
                                    <span class="message">
                                        {{$notification->data['message']}}
                                    </span>
                                    <span>
                                        <span class="time">{{date("H:i d-m-y", strtotime($notification->created_at))}}</span>
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </div>
                        <li>
                            <div class="text-center">
                                <a href="javascript:;" id="markReadAll">Đánh dấu tất cả đã đọc</a>
                            </div>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
