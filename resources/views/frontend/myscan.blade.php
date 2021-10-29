@extends('frontend.layouts.master')
@section('myscan-active','active fas')
@section('style')
    <style>
        #scan{
            width:100%;
            height: 300px;
        }
    </style>
@endsection
@section('content')
   <div class="card">
       <div class="card-body text-center">
        <h5 class="my-3">Scan MyPay QR</h5>
        <video id="scan"></video>
        <a href="{{route('transfer')}}" class="btn btn-primary my-3">Enter Phone Number Manually</a>
       </div>
   </div>
@endsection

@section('script')

<script src="{{asset('plugins/scan/qr-scanner.umd.min.js')}}"></script>
<script>
    QrScanner.WORKER_PATH = '{{asset('plugins/scan/qr-scanner-worker.min.js')}}';
    var videoElem=document.getElementById('scan');
    const qrScanner = new QrScanner(videoElem, function(result){
        if(result){
            qrScanner.stop();
            var to_phone=result;
            $.ajax({
                    url:`/transfer/hash?to_phone=${to_phone}`,
                    type:'GET',
                    success:function(res){
                       if(res.status=='success'){
                            var hash_value=res.data;
                            window.location.replace(`transfer/confirm?to_phone=${to_phone}&hash_value=${hash_value}`);
                    }
                   }
               })
        }
    });
    qrScanner.start();
</script>

@endsection