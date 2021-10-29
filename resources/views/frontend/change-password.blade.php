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
            <img src="{{asset('images/ui/change-password.png')}}" alt="" width="200px" class="d-block m-auto">
            <form action="{{route('changePassword')}}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
                <div class="form-group">
                    <label for="old-password">Old Password</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old-password" name="old_password" value="{{old('old_password')}}">
                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="password" name="new_password" value="{{old('new_password')}}">
                    @error('new_password')
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