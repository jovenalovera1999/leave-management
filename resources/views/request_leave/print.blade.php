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
            <p><strong class="fs-4">LEAVE DETAILS</strong></p>
            <p><strong>LEAVE TYPE:</strong> {{ $requestLeave->leave }}</p>
            <p>{{ date('m/d/Y', strtotime($requestLeave->leave_date_from)) . ' - ' . date('m/d/Y', strtotime($requestLeave->leave_date_to)) }}</p>
            <p><strong>REMAINING CREDITS:</strong> {{ $requestLeave->remaining_credits }}</p>
        </div>
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
