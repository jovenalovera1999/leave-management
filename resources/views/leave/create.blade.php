@extends('layout.main')

@section('title', 'ADD LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">ADD LEAVE</h5>
                <form action="/leave/store" method="post">
                    @csrf
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="leave">LEAVE</label>
                            <input type="text" class="form-control" name="leave" id="leave" value="{{ old('leave') }}" />
                            @error('leave')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="leave">NUMBER OF DAYS</label>
                            <input type="text" class="form-control" name="number_of_days" id="number_of_days" value="{{ old('number_of_days') }}" />
                            @error('number_of_days')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/leaves" class="btn btn-primary me-1">BACK</a>
                        <button type="submit" class="btn btn-primary">SAVE LEAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
