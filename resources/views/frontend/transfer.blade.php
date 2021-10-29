@extends('frontend.layouts.master')
@section('home-active','active fas')

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="#" class="back-btn mb-3 d-inline-block">Back</a>
            <form action="{{route('transferConfirm')}}" method="GET" autocomplete="off">
                
                <input type="hidden" name="hash_value" class="hash_value" value="">
                <div class="form-group">
                    <label for="" class="">Transfer to Phone Number</label>
                    <input type="number" class="form-control to_phone" name="to_phone" value="{{old('to_phone')}}">
                    @error('to_phone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary next-btn">Next</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready( function () {
           $(".next-btn").click(function(e){
               e.preventDefault();
               var to_phone=$(".to_phone").val();
               $.ajax({
                    url:`/transfer/hash?to_phone=${to_phone}`,
                    type:'GET',
                    success:function(res){
                       if(res.status=='success'){
                           $(".hash_value").val(res.data);
                           $("form").submit();
                    }
                   }
               })
           })
        } )
    </script>
@endsection