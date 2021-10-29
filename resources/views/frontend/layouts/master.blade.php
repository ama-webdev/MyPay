<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyPay</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('plugins/Fontawesome/css/all.css')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-4/css/bootstrap.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    {{-- Google font roboto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    {{-- Date Range Picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('frontend/css/utilities.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">

    @yield('style')
</head>

<body>
    <div class="wrapper">
        @include('frontend.layouts.nav')
        <div class="content">
            @yield('content')
        </div>
        @include('frontend.layouts.footer')
    </div>

    
    <!-- Jquery -->
    <script src="{{asset('frontend/plugins/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap Js -->
    <script src="{{asset('plugins/bootstrap-4/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- infinite scroll --}}
    <script src="{{asset('plugins/jsscroll/jsscroll.min.js')}}"></script>
    {{-- Data Range Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Custom Js -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    
    <script>
       $(document).ready(function(){
            let token = document.head.querySelector('meta[name="csrf-token"]')
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN': token.content,
                        'Content-Type':'application/json',
                        'Accept':'application/json',
                    }
                })
            }

            $(".back-btn").click(function(){
                window.history.go(-1);
            })

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            @if (session('created'))
                Toast.fire({
                icon: 'success',
                title: "{{ session('created') }}"
                })
            @endif
            @if (session('updated'))
                Toast.fire({
                icon: 'success',
                title: "{{ session('updated') }}"
                })
            @endif
            @if(session('fail'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{session('fail')}}",
            })
            @endif
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{session('success')}}",
            })
            @endif
       })
    </script>

    @yield('script')
</body>

</html>