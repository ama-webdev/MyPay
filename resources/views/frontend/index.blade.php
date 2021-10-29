@extends('frontend.layouts.master')
@section('home-active','active fas')

@section('content')
    <!-- balance -->
    <div class="balance-card">
        <p>Total Balance</p>
        <h5> @php
            echo number_format(Auth::user()->wallet->amount,2)
        @endphp MMK</h5>
    </div>
    <!-- Icons 3 -->
    <div class="icons">
        <div>
            <a href="{{route('transfer')}}">
                <i class="far fa-paper-plane"></i>
            </a>
            <span>Send Money</span>
        </div>
        <div>
            <a href="{{route('transaction')}}">
                <i class="far fa-exchange"></i>
            </a>
            <span>History</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-wallet"></i>
            </a>
            <span>Cash In/Out</span>
        </div>
    </div>
    <!-- features -->
    <div class="features">
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-mobile"></i>
            </a>
            <span>Topups</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-hands-usd"></i>
            </a>
            <span>Loans</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-ticket"></i>
            </a>
            <span>Tickets</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-gamepad"></i>
            </a>
            <span>Games</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-donate"></i>
            </a>
            <span>Donations</span>
        </div>
        <div>
            <a href="{{route('comming-soon')}}">
                <i class="far fa-gift-card"></i>
            </a>
            <span>Gifts</span>
        </div>
    </div>
    <!-- promotion -->
    <div class="promotions owl-carousel">
        <div class="promotion item1 p-3">
            <h6>Get Promotion Tickets By Doing Payment</h6>
            <span>You can get promotion tickets by paying at MyShop</span>
        </div>
        <div class="promotion item2">
            <h6>Pay Bills With Us</h6>
            <span>Be sure to pay your bills on time.</span>
        </div>
        <div class="promotion item3">
            <h6>Give Gifts & Get Fun</h6>
            <span>Love the giver more than the gift.</span>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready( function () {
            $( '.owl-carousel' ).owlCarousel( {
                loop: true,
                autoplay: true,
                margin: 10,
                responsive: {
                    0: {
                        items: 1
                    },
                }
            } )
        } )
    </script>
@endsection