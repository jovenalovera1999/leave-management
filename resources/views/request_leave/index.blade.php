@extends('layout.main')

@section('title', 'LIST OF REQUEST LEAVES')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">LIST OF REQUEST LEAVES</h5>
                    <a href="/request/leave/create" class="btn btn-primary">ADD REQUEST LEAVE</a>
                </div>
                <form action="#" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="search">SEARCH</label>
                            <input type="text" class="form-control mb-3" name="search_text" id="search_text" />
                        </div>
                        <div class="col-md-4">
                            <label for="date_from">FROM</label>
                            <input type="date" class="form-control mb-3" name="date_from" id="date_from" />
                        </div>
                        <div class="col-md-4">
                            <label for="date_to">TO</label>
                            <input type="date" class="form-control mb-3" name="date_to" id="date_to" />
                        </div>
                    </div>
                </form>
                {{ $requestLeaves->links() }}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">EMPLOYEE'S NAME</th>
                                <th scope="col">LEAVE TYPE</th>
                                <th scope="col">LEAVE DATE</th>
                                <th scope="col">REMAINING CREDITS</th>
                                <th scope="col">DATE CREATED</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = ($requestLeaves->currentPage() - 1) * $requestLeaves->perPage() + 1;
                            @endphp
                            @foreach ($requestLeaves as $requestLeave)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        {{ ($requestLeave->middle_name) ? $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->middle_name[0] . '. ' . $requestLeave->suffix_name : $requestLeave->last_name . ', ' . $requestLeave->first_name . ' ' . $requestLeave->suffix_name }}
                                    </td>
                                    <td>{{ $requestLeave->leave }}</td>
                                    <td>
                                        {{ date('m/d/Y', strtotime($requestLeave->leave_date_from)) . ' - ' . date('m/d/Y', strtotime($requestLeave->leave_date_to)) }}
                                    </td>
                                    <td>
                                        {{ $requestLeave->remaining_credits . ' CREDITS LEFT' }}
                                    </td>
                                    <td>{{ date('m/d/Y h:i A', strtotime($requestLeave->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/request/leave/edit/{{ $requestLeave->request_leave_id }}" class="btn btn-primary">EDIT</a>
                                            <a href="/request/leave/delete/{{ $requestLeave->request_leave_id }}" class="btn btn-primary">DELETE</a>
                                            <a href="/request/leave/print/{{ $requestLeave->request_leave_id }}" class="btn btn-primary">PRINT</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $requestLeaves->links() }}
            </div>
        </div>
    </div>
</main>

@endsection
