@extends('layout.main')

@section('title', 'DELETE REQUEST LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">DELETE REQUEST LEAVE</h5>
                <p class="card-text">ARE YOU SURE DO YOU WANT TO DELETE THIS REQUEST LEAVE BY {{ ($requestLeave->middle_name) ? $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->middle_name[0] . '. ' . $requestLeave->suffix_name : $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->suffix_name }} CREATED IN {{ date('m/d/Y h:i A', strtotime($requestLeave->created_at)) }}?</p>
                <div class="d-flex justify-content-end">
                    <form action="/request/leave/destroy/{{ $requestLeave->request_leave_id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a href="/request/leaves" class="btn btn-primary me-1">NO</a>
                        <button type="submit" class="btn btn-primary">YES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
