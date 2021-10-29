@extends('frontend.layouts.master')
@section('home-active','active fas')

@section('content')
    <div class="card">
        <div class="card-body">
        <a href="#" class="back-btn">Back</a>
               <div class="card">
                   <div class="card-header">
                       <small class="text-muted">Transfer to</small>
                       <h6 class="my-0">{{$user->name}}</h6>
                       <small class="text-muted">{{$user->phone}}</small>
                   </div>
                   <div class="card-body">
                       <form action="{{url('transfer/complete')}}" method="POST" autocomplete="off">
                       @csrf
                            <input type="hidden" value="{{$user->phone}}" name="to_phone">
                            <div class="form-group">
                                <label for="">Amount (MMK)</label>
                                <input type="number" name="amount" class="form-control amount">
                            </div>
                            <div class="form-group">
                                <label for="">Note (optional)</label>
                                <textarea name="note" class="form-control"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block submit-btn" value="Transfer">
                       </form>
                   </div>
               </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready( function () {
           $(".amount").keydown(function(e){
               if(!((e.keyCode > 95 && e.keyCode < 106)|| (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8)) {
                    return false;
                }
           })
           $(".amount").on("input", function() {
                if (/^0/.test(this.value)) {
                    this.value = this.value.replace(/^0/, "");
                }
            })
            $(".submit-btn").click(function(e){
                if($(".amount").val()=='' && $(".amount").val()==0){
                    e.preventDefault();
                }else{
                    e.preventDefault();

                        Swal.fire({
                        title: '<strong>Please enter your password.</strong>',
                        icon: 'info',
                        html:
                            '<input type="password" name="password" class="form-control text-center password">',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:'Confrim',
                        cancelButtonText:'Cancel',
                        reverseButtons:true,
                        }).then((result) => {
                        var password=$(".password").val();
                        if (result.isConfirmed) {
                            $.ajax({
                                url:'/password-check?password='+password,
                                type:'get',
                                success:function(res){
                                    if(res.status=='success'){
                                        $('form').submit();
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: res.message,
                                        })
                                    }
                                }
                            })
                        }
                        })
                }
            })
        } )
    </script>
@endsection