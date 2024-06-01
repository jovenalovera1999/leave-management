@extends('layout.main')

@section('title', 'DELETE LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">DELETE LEAVE</h5>
                <p class="card-text">ARE YOU SURE DO YOU WANT TO DELETE THIS LEAVE NAMED {{ $leave->leave }}?</p>
                <form action="/leave/destroy/{{ $leave->leave_id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="d-flex justify-content-end">
                        <a href="/leaves" class="btn btn-primary me-1">NO</a>
                        <button type="submit" class="btn btn-primary">YES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
