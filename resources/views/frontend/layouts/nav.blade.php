<div class="top-nav">
    <a href="{{route('home')}}" class="left">
        <h5>Hi, {{Auth::user()->name}}</h5>
        <p>Today @php
            echo date('D , d M');
        @endphp</p>
    </a>
    <div class="right">
        <a href="{{route('notifications')}}" class="@yield('noti-active')">
            <i class="far fa-bell"></i>
            @if ($unread_noti_count > 0)
                <span class="badge badge-pill badge-danger unread_noti_count">{{$unread_noti_count}}</span>
            @endif
        </a>
    </div>
</div>