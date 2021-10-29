@extends('frontend.layouts.master')
@section('menu-active','active fas')
@section('style')
<style>
    .invalid-feedback{
        display: block !important;
    }
</style>
@endsection
@section('content')
    <div class="card">
        
        <div class="card-body">
             <div class="form-group">
                <a href="#" class="back-btn">Back</a>
            </div>
            <img src="{{asset('images/ui/change-phone.png')}}" alt="" width="200px" class="d-block m-auto">
            <form action="{{route('changePhone')}}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone')}}">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="form-control mt-4 btn btn-primary">Change</button>
                </div>
               
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready( function () {
            
        } )
        
    </script>
@endsection