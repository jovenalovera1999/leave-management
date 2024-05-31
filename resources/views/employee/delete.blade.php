@extends('layout.main')

@section('title', 'DELETE EMPLOYEE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">DELETE EMPLOYEE</h5>
                <p class="card-text">Are you sure do you want to delete this employee named --Name of employee--?</p>
                <form action="#" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-primary col-md-3 me-1">NO</a>
                        <button type="submit" class="btn btn-danger col-md-3">YES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
