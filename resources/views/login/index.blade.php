@extends('layout.main')

@section('title', 'LOGIN AUTHENTICATION')

@section('content')

<div class="container-fluid">
    @include('include.message')
    <div class="card col-md-4 mx-auto mt-2">
        <div class="card-body">
            <h5 class="card-title d-flex align-items-center">
                <img src="{{ asset('img/general/CompanyLogo.png') }}" alt="" class="img-fluid rounded-circle me-3" width="50px" height="50px" />
                LOGIN AUTHENTICATION | LEAVE MANAGEMENT
            </h5>
            <form action="/process/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username">USERNAME</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" />
                </div>
                <div class="mb-3">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" />
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
