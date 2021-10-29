@extends('frontend.layouts.master')
@section('style')
<style>
    .card{
        height: calc(100vh - 10rem);
    }
    .card-body{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 2rem;
    }
    h1{
        opacity: .3;
        font-size: 4rem;
        font-weight: 900;
        text-transform: uppercase;
        text-align: center;
    }
</style>
@endsection

@section('content')
   <div class="card">
       <div class="card-body">
           <h1 class="text-muted">Comming Soon</h1>
           <a href="#" class="btn btn-outline-secondary back-btn">Back</a>
       </div>
   </div>
@endsection