@extends('layout.main')

@section('title', 'PRINT REQUEST LEAVE')

@section('content')

<section class="ms-5 mt-2 me-5 mb-2">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-5">REQUEST LEAVE DETAILS</h2>
        <p><strong>DATE:</strong> {{ date('m/d/Y', strtotime(now())) }}</p>
    </div>
    <p><strong>EMPLOYEE NAME:</strong> <u>DELA CRUZ, JUAN</u></p>
    <p><strong>DEPARTMENT:</strong> <u>CCS</u></p>
    <p class="mb-5"><strong>POSITION:</strong> <u>PART-TIME FACULTY</u></p>
    <div class="row mb-3">
        <div class="col-md-4">
            <p><strong class="fs-4">REGULAR DATE SCHEDULE</strong></p>
            <p>DATE FROM - DATE TO</p>
        </div>
        <div class="col-md-4">
            <p><strong class="fs-4">LEAVE DETAILS</strong></p>
            <p><strong>LEAVE TYPE:</strong> SICK LEAVE FOR EXAMPLE</p>
            <p>DATE FROM - DATE TO</p>
        </div>
        <div class="col-md-4">
            <p><strong class="fs-4">ATTENDED DATE</strong></p>
            <p>DATE FROM - DATE TO</p>
        </div>
    </div>
    <p><strong class="fs-4">SALARY DETAILS</strong></p>
    <p><strong>REGULAR SALARY:</strong> 20,000.00</p>
    <p><strong>SALARY DEDUCTION PER DAY:</strong> 2,000.00</p>
    <p><strong>DEDUCTED SALARY:</strong> 2,000.00</p>
    <p><strong>FINAL SALARY:</strong> 18,000.00</p>
</section>

@endsection
