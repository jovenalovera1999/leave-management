@extends('layout.main')

@section('title', 'LIST OF TYPES OF LEAVE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">LIST OF TYPES OF LEAVE</h5>
                    <a href="/leave/create" class="btn btn-primary">ADD TYPE OF LEAVE</a>
                </div>
                <form action="/leaves" method="get">
                    <label for="search">SEARCH</label>
                    <input type="text" class="form-control mb-3" name="search" id="search" />
                </form>
                {{ $leaves->links() }}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">LEAVE</th>
                                <th scope="col">NUMBER OF DAYS PER YEAR</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = ($leaves->currentPage() - 1) * $leaves->perPage() + 1;
                            @endphp
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $leave->leave }}</td>
                                    <td>{{ $leave->number_of_days . ' days' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/leave/edit/{{ $leave->leave_id }}" class="btn btn-primary">EDIT</a>
                                            <a href="/leave/delete/{{ $leave->leave_id }}" class="btn btn-primary">DELETE</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</main>

@endsection
