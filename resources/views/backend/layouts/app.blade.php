<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyDash</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('plugins/Fontawesome/css/all.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4/css/bootstrap.min.css') }}">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('backend/css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}">

    @yield('styles')
</head>

<body>
    <div class="wrapper">
        {{-- sidebar --}}
        @include('backend.layouts.sidebar')
        <div class="content">
            {{-- Navigation --}}
            @include('backend.layouts.nav')
            <div class="content-body">
                @yield('content')
            </div>
            {{-- Footer --}}
            @include('backend.layouts.footer')
        </div>
    </div>

    <!-- Jquery -->
    <script src="{{ asset('plugins/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('plugins/bootstrap-4/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Js -->
    <script src="{{ asset('backend/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            let token = document.head.querySelector('meta[name="csrf-token"]')
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN': token.content
                    }
                })
            }
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
        })
    </script>
    @yield('script')
</body>

</html>
