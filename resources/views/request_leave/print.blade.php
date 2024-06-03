@extends('layout.main')

@section('title', 'PRINT REQUEST LEAVE')

@section('content')

<style>
    @media print {
        /* Set default page size */
        @page {
            size: A4;
        }

        body {
            /* Set font size default */
            font-size: 12pt;
        }
    }
</style>

<section class="ms-5 mt-2 me-5 mb-2">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-5">REQUEST LEAVE DETAILS</h2>
        <p><strong>DATE:</strong> {{ date('m/d/Y', strtotime(now())) }}</p>
    </div>
    <p><strong>EMPLOYEE NAME:</strong> <u>{{ ($requestLeave->middle_name) ? $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->middle_name[0] . '. ' . $requestLeave->suffix_name : $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->suffix_name }}</u></p>
    <p><strong>DEPARTMENT:</strong> <u>{{ $requestLeave->department }}</u></p>
    <p class="mb-5"><strong>POSITION:</strong> <u>{{ $requestLeave->position }}</u></p>
    <div class="row mb-3">
        <div class="col-md-4">
            <p><strong class="fs-4">REGULAR DATE SCHEDULE</strong></p>
            <p>{{ date('m/d/Y', strtotime($requestLeave->regular_schedule_date_from)) . ' - ' . date('m/d/Y', strtotime($requestLeave->regular_schedule_date_to)) }}</p>
        </div>
        <div class="col-md-4">
            <p><strong class="fs-4">LEAVE DETAILS</strong></p>
            <p><strong>LEAVE TYPE:</strong> {{ $requestLeave->leave }}</p>
            <p>{{ date('m/d/Y', strtotime($requestLeave->leave_date_from)) . ' - ' . date('m/d/Y', strtotime($requestLeave->leave_date_to)) }}</p>
        </div>
        <div class="col-md-4">
            <p><strong class="fs-4">ATTENDED DATE</strong></p>
            <p>
                @if (empty($requestLeave->attended_date_from) && empty($requestLeave->requestLeave->attended_date_to))
                    N/A
                @else
                    {{ date('m/d/Y', strtotime($requestLeave->attended_date_from)) . ' - ' . date('m/d/Y', strtotime($requestLeave->attended_date_from)) }}
                @endif
            </p>
        </div>
    </div>
    <p><strong class="fs-4">SALARY DETAILS</strong></p>
    <p><strong>REGULAR SALARY:</strong> {{ number_format($requestLeave->regular_salary, 2, '.', ',') }}</p>
    <p><strong>SALARY DEDUCTION PER DAY:</strong> {{ (empty($requestLeave->salary_deduction_per_day)) ? 'N/A' : number_format($requestLeave->salary_deduction_per_day, 2, '.', ',') }}</p>
    <p><strong>DEDUCTED SALARY:</strong> {{ (empty($requestLeave->deducted_salary)) ? 'N/A' : number_format($requestLeave->deducted_salary, 2, '.', ',') }}</p>
    <p><strong>FINAL SALARY:</strong> {{ (empty($requestLeave->final_salary)) ? 'N/A' : number_format($requestLeave->final_salary, 2, '.', ',') }}</p>
</section>

<script>
    // Function to handle the print event
    function handlePrint() {
        // Print the page after a brief delay to ensure it loads properly
        setTimeout(function() {
            window.print();
        }, 500);

        // Add an event listener to detect when the print dialog is closed
        window.addEventListener('afterprint', function(event) {
            // Go back to the previous page
            window.history.back();
        });
    }

    // Call the handlePrint function when the window loads
    window.onload = function() {
        handlePrint();
    };
</script>

@endsection
