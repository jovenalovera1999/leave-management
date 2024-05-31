@extends('layout.main')

@section('title', 'LIST OF DEPARTMENTS')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">LIST OF DEPARTMENTS</h5>
                    <a href="/department/create" class="btn btn-primary">ADD DEPARTMENT</a>
                </div>
                <form action="/departments" method="get">
                    <label for="search">SEARCH</label>
                    <input type="text" class="form-control mb-3" name="search" id="search" />
                </form>
                {{ $departments->links() }}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">DEPARTMENT</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = ($departments->currentPage() - 1) * $departments->perPage() + 1;
                            @endphp
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $department->department }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/department/edit/{{ $department->department_id }}" class="btn btn-primary">EDIT</a>
                                            <a href="/department/delete/{{ $department->department_id }}" class="btn btn-primary">DELETE</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $departments->links() }}
            </div>
        </div>
    </div>
</main>

@endsection
