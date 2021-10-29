@extends('frontend.layouts.master')
@section('myqr-active','active fas')

@section('content')
   <div class="card">
       <div class="card-body text-center">
        <p>Scan this QR code to send money to you.</p>
          <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate(Auth::user()->phone)) !!} ">
        <p class="mb-1">{{Auth::user()->name}}</p>
        <h5 class="">{{Auth::user()->phone}}</h5>
       </div>
   </div>
@endsection

@section('script')
    
@endsection