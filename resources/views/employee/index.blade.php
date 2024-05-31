@extends('layout.main')

@section('title', 'LIST OF EMPLOYEES')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">LIST OF EMPLOYEES</h5>
                    <a href="#" class="btn btn-primary">ADD EMPLOYEE</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">BIRTH DATE</th>
                                <th scope="col">ADDRESS</th>
                                <th scope="col">CONTACT NUMBER</th>
                                <th scope="col">DEPARTMENT</th>
                                <th scope="col">POSITION</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection