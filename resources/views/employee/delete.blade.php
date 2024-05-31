@extends('layout.main')

@section('title', 'DELETE EMPLOYEE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">DELETE EMPLOYEE</h5>
                <p class="card-text">ARE YOU SURE DO YOU WANT TO DELETE THIS EMPLOYEE NAMED {{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . '. ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}?</p>
                <form action="/employee/destroy/{{ $employee->employee_id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="d-flex justify-content-end">
                        <a href="/employees" class="btn btn-primary me-1">NO</a>
                        <button type="submit" class="btn btn-primary">YES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
