<div class="top-nav">
    <a href="{{route('home')}}" class="left">
        <h5>Hi, {{Auth::user()->name}}</h5>
        <p>Today @php
            echo date('D , d M');
        @endphp</p>
    </a>
    <div class="right">
        <a href="">
            <i class="far fa-bell"></i>
        </a>
    </div>
</div>