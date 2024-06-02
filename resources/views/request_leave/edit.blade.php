@extends('layout.main')

@section('title', 'EDIT REQUEST LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <form action="/request/leave/update/{{ $requestLeave->request_leave_id }}" method="post">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <h5 class="card-title">EDIT REQUEST LEAVE</h5>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">EMPLOYEE DETAILS</h5>
                                    <div class="mb-3">
                                        <label for="employee">EMPLOYEE NAME</label>
                                        <select class="form-select" name="employee" id="employee">
                                            <option value="">N/A</option>
                                            <option value="{{ $requestLeave->employee_id }}" selected hidden>{{ ($requestLeave->middle_name) ? $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->middle_name[0] . '. ' . $requestLeave->suffix_name : $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->suffix_name }}</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->employee_id }}">{{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . '. ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}</option>
                                                @if (old('employee') == $employee->employee_id)
                                                    <option value="{{ $employee->employee_id }}" selected hidden>{{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . '. ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('employee')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="regular_salary">REGULAR SALARY</label>
                                        <input type="text" class="form-control" name="regular_salary" id="regular_salary" value="{{ old('regular_salary', $requestLeave->regular_salary) }}" />
                                        @error('regular_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">REGULAR DATE SCHEDULE</h5>
                                    <div class="mb-3">
                                        <label for="regular_schedule_date_from">FROM</label>
                                        <input type="date" class="form-control" name="regular_schedule_date_from" id="regular_schedule_date_from" value="{{ old('regular_schedule_date_from', $requestLeave->regular_schedule_date_from) }}" />
                                        @error('regular_schedule_date_from')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="regular_schedule_date_to">TO</label>
                                        <input type="date" class="form-control" name="regular_schedule_date_to" id="regular_schedule_date_to" value="{{ old('regular_schedule_date_to', $requestLeave->regular_schedule_date_to) }}" />
                                        @error('regular_schedule_date_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">LEAVE DETAILS</h5>
                                    <div class="mb-3">
                                        <label for="leave">LEAVE TYPE</label>
                                        <select class="form-select" name="leave" id="leave">
                                            <option value="">N/A</option>
                                            <option value="{{ $requestLeave->leave_id }}" selected hidden>{{ $requestLeave->leave }}</option>
                                            @foreach ($leaves as $leave)
                                                <option value="{{ $leave->leave_id }}">{{ $leave->leave }}</option>
                                                @if (old('leave') == $leave->leave_id)
                                                    <option value="{{ $leave->leave_id }}" selected hidden>{{ $leave->leave }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('leave')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="leave_date_from">FROM</label>
                                        <input type="date" class="form-control" name="leave_date_from" id="leave_date_from" value="{{ old('leave_date_from', $requestLeave->leave_date_from) }}" />
                                        @error('leave_date_from')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="leave_date_to">TO</label>
                                        <input type="date" class="form-control" name="leave_date_to" id="leave_date_to" value="{{ old('leave_date_to', $requestLeave->leave_date_to) }}" />
                                        @error('leave_date_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">ATTENDED DATE</h5>
                                    <div class="mb-3">
                                        <label for="attended_date_from">FROM</label>
                                        <input type="date" class="form-control" name="attended_date_from" id="attended_date_from" value="{{ old('attended_date_from', $requestLeave->attended_date_from) }}" />
                                        @error('attended_date_from')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="attended_date_to">TO</label>
                                        <input type="date" class="form-control" name="attended_date_to" id="attended_date_to" value="{{ old('attended_date_to', $requestLeave->attended_date_to) }}" />
                                        @error('attended_date_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">SALARY DETAILS</h5>
                                    <div class="mb-3">
                                        <label for="salary_deduction_per_day">SALARY DEDUCTION PER DAY</label>
                                        <input type="text" class="form-control" name="salary_deduction_per_day" id="salary_deduction_per_day" value="{{ old('salary_deduction_per_day', $requestLeave->salary_deduction_per_day) }}" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="deducted_salary">DEDUCTED SALARY</label>
                                        <input type="text" class="form-control" name="deducted_salary" id="deducted_salary" value="{{ old('deducted_salary', $requestLeave->deducted_salary) }}" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="final_salary">FINAL SALARY</label>
                                        <input type="number" step="0.01" class="form-control" name="final_salary" id="final_salary" value="{{ old('final_salary', $requestLeave->final_salary) }}" readonly />
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
