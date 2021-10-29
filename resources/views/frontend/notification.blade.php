@extends('frontend.layouts.master')
@section('noti-active','active fas')
@section('style')
    <style>
       img{
           width:200px;
       }
    </style>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <a href="#" class="back-btn">Back</a>
        <div class="text-center">
            <img src="{{asset('images/ui/notification.png')}}" alt="">
            <p class="font-weight-bold">{{$notification->data['title']}}</p>   
            <p>{{$notification->data['message']}}</p>
            <p>{{Carbon\Carbon::parse($notification->created_at)->format('d M ,Y H:i:s A')}}</p>
            <a href="{{$notification->data['web_link']}}" class="btn btn-primary btn-sm">Continue</a>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection