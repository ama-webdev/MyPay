<div class="bot-nav">
    <a href="{{route('home')}}" class="@yield('home-active')">
        <i class="fas fa-home-alt"></i>
    </a>
    <a href="{{route('myqr')}}" class="@yield('myqr-active')">
        <i class="far fa-qrcode"></i>
    </a>
    <a href="{{route('myscan')}}" class="@yield('myscan-active')">
        <i class="far fa-barcode-read"></i>
    </a>
    <a href="{{route('transaction')}}" class="@yield('transaction-active')">
        <i class="far fa-exchange"></i>
    </a>
    <a href="{{route('menu')}}" class="@yield('menu-active')">
        <i class="far fa-bars"></i>
    </a>
</div>