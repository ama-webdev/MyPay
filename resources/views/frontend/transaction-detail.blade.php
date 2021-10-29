@extends('frontend.layouts.master')
@section('transaction-active','active fas')
@section('style')
<style>
    table tr td{
        border:none !important;
    }
    table tr td:last-child{
        text-align: right;
    }
    .fa-4x{
        color:var(--primary-color);
    }
</style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="#" class="back-btn">Back</a>
            <i class="fas fa-check-circle fa-4x d-block text-center mb-3"></i>
            <p class="text-center text-muted mb-3">Successfully Transfer.</p>
            @if ($transaction->type==1)
                <h5 class="text-center text-success">+ @php
                   echo number_format($transaction->amount);
                @endphp Ks</h5>
            @elseif($transaction->type==2)
                <h5 class="text-center text-danger">- @php
                  echo number_format($transaction->amount);
                @endphp Ks</h5>
            @endif
            <hr>
            <table class="table text-muted">
                <tr>
                    <td>Transaction Time</td>
                    <td>{{\Carbon\Carbon::parse($transaction->created_at)->format('d M , Y / h:i:s A')}}
                </td>
                </tr>
                <tr>
                    <td>Transaction Id</td>
                    <td>{{$transaction->trx_id}}</td>
                </tr>
                <tr>
                    <td>ref no</td>
                    <td>{{$transaction->ref_no}}</td>
                </tr>
                <tr>
                    <td>Transaction Type</td>
                    <td>
                        @if ($transaction->type==1)
                            Receive Money
                        @elseif($transaction->type==2)
                            Send Money
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($transaction->type==1)
                            Transfer From
                        @elseif($transaction->type==2)
                            Transfer To
                        @endif
                    </td>
                    <td>{{$transaction->source->phone}}</td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>
                        @if ($transaction->type==1)
                            + 
                        @elseif($transaction->type==2)
                            - 
                        @endif
                        @php
                            echo number_format($transaction->amount)
                        @endphp Ks
                    </td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>{{$transaction->note}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('script')
    
@endsection