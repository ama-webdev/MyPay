@extends('backend.layouts.app')
@section('user-active', 'active')
@section('admin-user-active', 'active')

@section('content')
    <div class="content-title">
        <div>
            <i class="far fa-user-plus"></i><span>Create User</span>
        </div>
        <a href="#" class="btn btn-primary btn-sm mt-2 back-btn"><i class="far fa-undo"></i>Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')
            <form action="{{ route('admin.users.store') }}" method="POST" id="create">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreUser', '#create') !!}
    <script>
        $(document).rady(function() {

        })
    </script>
@endsection
