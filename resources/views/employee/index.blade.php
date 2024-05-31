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
                    <a href="/employee/create" class="btn btn-primary">ADD EMPLOYEE</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">BIRTH DATE</th>
                                <th scope="col">AGE</th>
                                <th scope="col">ADDRESS</th>
                                <th scope="col">CONTACT NUMBER</th>
                                <th scope="col">DEPARTMENT</th>
                                <th scope="col">POSITION</th>
                                <th scope="col">DATE CREATED</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp

                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        {{ ($employee->middle_name) ? $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name[0] . ' ' . $employee->suffix_name : $employee->last_name . ', ' . $employee->first_name . ' ' . $employee->suffix_name }}
                                    </td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ date('m/d/Y', strtotime($employee->birth_date)) }}</td>
                                    <td>{{ $employee->age }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->contact_number }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ date('m/d/Y, h:i A', strtotime($employee->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/employee/edit/{{ $employee->employee_id }}" class="btn btn-primary">EDIT</a>
                                            <a href="/employee/delete/{{ $employee->employee_id }}" class="btn btn-primary">DELETE</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
