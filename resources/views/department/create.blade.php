@extends('layout.main')

@section('title', 'ADD DEPARTMENT')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">ADD DEPARTMENT</h5>
                <form action="/department/store" method="post">
                    @csrf
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="department">DEPARTMENT</label>
                            <input type="text" class="form-control" name="department" id="department" value="{{ old('department') }}" />
                            @error('department')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/departments" class="btn btn-primary me-1">BACK</a>
                        <button type="submit" class="btn btn-primary">SAVE DEPARTMENT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
