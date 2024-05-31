@extends('layout.main')

@section('title', 'ADD POSITION')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">ADD POSITION</h5>
                <form action="/position/store" method="post">
                    @csrf
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="position">POSITION</label>
                            <input type="text" class="form-control" name="position" id="position" value="{{ old('position') }}" />
                            @error('position')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/positions" class="btn btn-primary me-1">BACK</a>
                        <button type="submit" class="btn btn-primary">SAVE POSITION</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
