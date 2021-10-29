@extends('frontend.layouts.master')
@section('menu-active','active fas')

@section('content')

    {{-- <div class="profile-header">
        <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&background=6c5ce7&color=fff&font-size=0.36" alt="" class="profile-img">
        <div>
            <span class="name">{{Auth::user()->name}}</span>
            <span>{{Auth::user()->wallet->account_number}}</span>
            <span>{{Auth::user()->phone}}</span>
        </div>
    </div> --}}
    <div class="profile-body">
        <div class="card">
            <div class="card-body">
                <ul>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-ticket"></i> Cupons</a><i class="far fa-angle-right"></i></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul>
                    <li><a href="{{route('changePassword')}}"><i class="far fa-lock"></i> Change Password</a> <i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('changePhone')}}"><i class="far fa-mobile"></i> Change Phone Number</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-globe-asia"></i> Choose Language</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-shield"></i> Limit & Free</a><i class="far fa-angle-right"></i></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-book-open"></i> Tutorials</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-question-circle"></i> Helps & Feedback</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-grin-stars"></i> About MyPay</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-share"></i> Share App</a><i class="far fa-angle-right"></i></li>
                    <li><a href="{{route('comming-soon')}}"><i class="far fa-cog"></i> Settings</a><i class="far fa-angle-right"></i></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul>
                    <li>
                        <a href="#" class="logout-btn">Logout</a><i class="far fa-angle-right"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        $( document ).ready( function () {
            $(".logout-btn").click(function(){
                Swal.fire({
                    title: 'Confirm exit ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    reverseButtons:true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{route('logout')}}",
                            type:'POST',
                            success:function(){
                                window.location.replace("{{route('menu')}}");
                            }
                        })
                    }
                })
            })
             
        } )
    </script>
@endsection