@extends('layout.main')

@section('title', 'EDIT DEPARTMENT')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">EDIT DEPARTMENT</h5>
                <form action="/department/update/{{ $department->department_id }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="department">DEPARTMENT</label>
                            <input type="text" class="form-control" name="department" id="department" value="{{ old('department', $department->department) }}" />
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
