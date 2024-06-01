@extends('layout.main')

@section('title', 'ADD REQUEST LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <form action="#" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">ADD REQUEST LEAVE</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">EMPLOYEE DETAILS</h5>
                            <div class="mb-3">
                                <label for="employee">EMPLOYEE NAME</label>
                                <select class="form-select" name="employee" id="employee">
                                    <option value="" selected>N/A</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->employee_id }}">{{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . '. ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="regular_salary">REGULAR SALARY</label>
                                <input type="text" class="form-control" name="regular_salary" id="regular_salary" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">REGULAR SCHEDULE</h5>
                            <div class="mb-3">
                                <label for="regular_schedule_date_from">FROM</label>
                                <input type="date" class="form-control" name="regular_schedule_date_from" id="regular_schedule_date_from" />
                            </div>
                            <div class="mb-3">
                                <label for="regular_schedule_date_to">TO</label>
                                <input type="date" class="form-control" name="regular_schedule_date_to" id="regular_schedule_date_to" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">LEAVE DATE</h5>
                            <div class="mb-3">
                                <label for="leave_date_from">FROM</label>
                                <input type="date" class="form-control" name="leave_date_from" id="leave_date_from" />
                            </div>
                            <div class="mb-3">
                                <label for="leave_date_to">TO</label>
                                <input type="date" class="form-control" name="leave_date_to" id="leave_date_to" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">ATTENDED DATE</h5>
                            <div class="mb-3">
                                <label for="attended_date_from">FROM</label>
                                <input type="date" class="form-control" name="attended_date_from" id="attended_date_from" />
                            </div>
                            <div class="mb-3">
                                <label for="attended_date_to">TO</label>
                                <input type="date" class="form-control" name="attended_date_to" id="attended_date_to" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">SALARY DETAILS</h5>
                            <div class="mb-3">
                                <label for="salary_deduction_per_day">SALARY DEDUCTION PER DAY</label>
                                <input type="text" class="form-control" name="salary_deduction_per_day" id="salary_deduction_per_day" />
                            </div>
                            <div class="mb-3">
                                <label for="deducted_salary">DEDUCTED SALARY</label>
                                <input type="text" class="form-control" name="deducted_salary" id="deducted_salary" />
                            </div>
                            <div class="mb-3">
                                <label for="final_salary">FINAL SALARY</label>
                                <input type="number" step="0.01" class="form-control" name="final_salary" id="final_salary" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('input', calculateSalaryDeduction);

function calculateDaysBetween(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const timeDiff = end - start;
    return timeDiff / (1000 * 60 * 60 * 24) + 1; // Add 1 to include both start and end dates
}

function calculateSalaryDeduction() {
    const regularSalary = parseFloat(document.getElementById('regular_salary').value) || 0;

    const scheduleFrom = document.getElementById('regular_schedule_date_from').value;
    const scheduleTo = document.getElementById('regular_schedule_date_to').value;
    const leaveFrom = document.getElementById('leave_date_from').value;
    const leaveTo = document.getElementById('leave_date_to').value;
    const attendedFrom = document.getElementById('attended_date_from').value;
    const attendedTo = document.getElementById('attended_date_to').value;

    if (scheduleFrom && scheduleTo && leaveFrom && leaveTo && attendedFrom && attendedTo) {
        const totalScheduleDays = calculateDaysBetween(scheduleFrom, scheduleTo);
        const leaveDays = calculateDaysBetween(leaveFrom, leaveTo);
        const attendedDays = calculateDaysBetween(attendedFrom, attendedTo);

        const daysMissed = totalScheduleDays - leaveDays - attendedDays;

        const salaryDeductionPerDay = regularSalary / totalScheduleDays;
        const deductedSalary = daysMissed * salaryDeductionPerDay;
        const finalSalary = regularSalary - deductedSalary;

        document.getElementById('salary_deduction_per_day').value = salaryDeductionPerDay.toFixed(2);
        document.getElementById('deducted_salary').value = deductedSalary.toFixed(2);
        document.getElementById('final_salary').value = finalSalary.toFixed(2);
    }
}
</script>

@endsection
