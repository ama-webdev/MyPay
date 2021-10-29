@extends('frontend.layouts.master')
@section('transaction-active','active fas')
@section('style')
    <style>
        a{
            text-decoration:none !important;
            color:var(--text-muted);
        }
        a:hover{
            text-decoration: none !important;
            color:var(--text-muted);
        }
        .infinite-scroll{
            height: fit-content;
            overflow: auto
        }
        .from-to,.date{
            font-size:0.9rem;
            margin:0;
            padding:0;
        }
    </style>
@endsection

@section('content')
 <div class="card">
     <h5 class="mx-1 my-1">Transactions</h5>
    <div class="d-flex justify-content-between">
        <div class="input-group my-2 mx-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="date">Date</label>
            </div>
            <input type="text" id="date" class="form-control" value="{{request()->date ?? date('Y-m-d')}}">
        </div>
         <div class="input-group my-2 mx-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="type">Type</label>
            </div>
            <select class="custom-select" id="type">
                <option value="">All</option>
                <option value="1" @if (request()->type==1)
                    selected
                @endif>Received</option>
                <option value="2" @if (request()->type==2)
                    selected
                @endif>Send</option>
            </select>
        </div>
    </div>
</div>
<div class="infinite-scroll">
    @foreach ($transactions as $transaction)
        <a href="{{route('transactionDetail',$transaction->trx_id)}}">
            <div class="card mb-1">
            <div class="card-body"> 
                <div class="d-flex justify-content-between">
                    @if ($transaction->type==1)
                        <h6 class="font-weight-bold mb-2">Receive Money</h6>
                    @else
                        <h6 class="font-weight-bold mb-2">Send Money</h6>
                    @endif
                    <p class="mb-0 @if($transaction->type==1) text-success @elseif($transaction->type==2)text-danger @endif">
                    @if ($transaction->type==1)
                        +
                    @else
                        -
                    @endif
                        @php
                           echo number_format($transaction->amount)." Ks";
                        @endphp
                    </p>
                </div>
                <p class="text-muted mb-1 from-to">
                    @if ($transaction->type==1)
                        From - 
                    @elseif($transaction->type==2)
                        To -
                    @endif
                    {{$transaction->source ? $transaction->source->phone:''}}
                </p>
                <p class="text-muted mb-1 date">
                    {{\Carbon\Carbon::parse($transaction->created_at)->format('d M , Y / h:i:s A')}}
                </p>
            </div>
        </div>
        </a>
    @endforeach
    {{$transactions->links()}}
</div>
@endsection

@section('script')
    <script>
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });

        $("#type").change(function(){
            var date=$("#date").val();
            var type=$("#type").val();
            history.pushState(null,'',`?type=${type}&date=${date}`);
            window.location.reload();
        })

        $('#date').daterangepicker({
            "singleDatePicker": true,
            "autoApply": true,
            "locale": {
                "format": "YYYY-MM-DD",
            },
        });

        $('#date').on('apply.daterangepicker', function(ev, picker) {
            var date=$("#date").val();
            var type=$("#type").val();
            history.pushState(null,'',`?type=${type}&date=${date}`);
            window.location.reload();
        });
    });
</script>
@endsection