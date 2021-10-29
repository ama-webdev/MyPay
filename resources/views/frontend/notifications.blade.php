@extends('frontend.layouts.master')
@section('noti-active','active fas')
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
       <div class="card-body">
        <h5 class="">Notifications</h5>
        <div class="infinite-scroll">
            @foreach ($notifications as $notification)
            <div class="card mb-1">
                <div class="card-body">
                    <a href="{{route('notification',$notification->id)}}">
                        <div class="d-flex justify-content-between">
                            <h6 class="@if(is_null($notification->read_at)) font-weight-bold @endif mb-2">{{$notification->data['title']}}</h6>
                        </div>
                        <p class="text-muted mb-1 from-to">
                            {{Illuminate\Support\Str::limit($notification->data['message'], 50, '...')}}
                        </p>
                        <p class="text-muted mb-1 date">
                            {{\Carbon\Carbon::parse($notification->created_at)->format('d M , Y / h:i:s A')}}
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
            {{$notifications->links()}}
        </div>
       </div>
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