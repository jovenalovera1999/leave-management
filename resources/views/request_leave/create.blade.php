@extends('layout.main')

@section('title', 'ADD REQUEST LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <form action="/request/leave/store" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">ADD REQUEST LEAVE</h5>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">EMPLOYEE DETAILS</h5>
                                    <div class="mb-3">
                                        <label for="employee">EMPLOYEE NAME</label>
                                        <select class="form-select" name="employee" id="employee">
                                            <option value="" selected>N/A</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->employee_id }}" {{ (old('employee') == $employee->employee_id) ? 'selected' : '' }}>
                                                    {{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . '. ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">LEAVE DETAILS</h5>
                                    <div class="mb-3">
                                        <label for="leave">LEAVE TYPE</label>
                                        <select class="form-select" name="leave" id="leave">
                                            <option value="" selected>N/A</option>
                                            @foreach ($leaves as $leave)
                                                <option value="{{ $leave->leave_id }}" {{ (old('leave') == $leave->leave_id) ? 'selected' : '' }}>
                                                    {{ $leave->leave }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('leave')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="leave_date_from">FROM</label>
                                        <input type="date" class="form-control" name="leave_date_from" id="leave_date_from" value="{{ old('leave_date_from') }}" />
                                        @error('leave_date_from')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="leave_date_to">TO</label>
                                        <input type="date" class="form-control" name="leave_date_to" id="leave_date_to" value="{{ old('leave_date_to') }}" />
                                        @error('leave_date_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/request/leaves" class="btn btn-primary me-1">BACK</a>
                        <button type="submit" class="btn btn-primary">SAVE REQUEST</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="{{ asset('js/calculatesalarydeduction.js') }}"></script>

@endsection
