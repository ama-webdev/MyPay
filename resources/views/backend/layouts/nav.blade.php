<nav class="navbar">
    <div class="left">
        <i class="fas fa-bars sidebar-toggler"></i>
    </div>
    <div class="right">
        <div class="dropdown">
            <a href="#" class="dropbtn"><i class="far fa-bell"></i></a>
            <div class="dropdown-content">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropbtn"><i class="far fa-comment"></i></a>
            <div class="dropdown-content">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropbtn profile"><img
                    src="https://ui-avatars.com/api/?name={{ auth()->guard('admin_user')->user()->name }}"
                    alt="">{{ auth()->guard('admin_user')->user()->name }}</a>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
