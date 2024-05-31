@extends('layout.main')

@section('title', 'LIST OF POSITIONS')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        @include('include.message')
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">LIST OF POSITIONS</h5>
                    <a href="/position/create" class="btn btn-primary">ADD POSITION</a>
                </div>
                <form action="/positions" method="get">
                    <label for="search">SEARCH</label>
                    <input type="text" class="form-control mb-3" name="search" id="search" />
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">POSITION</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = ($positions->currentPage() - 1) * $positions->perPage() + 1;
                            @endphp
                            @foreach ($positions as $position)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $position->position }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/position/edit/{{ $position->position_id }}" class="btn btn-primary">EDIT</a>
                                            <a href="/position/delete/{{ $position->position_id }}" class="btn btn-primary">DELETE</a>
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
