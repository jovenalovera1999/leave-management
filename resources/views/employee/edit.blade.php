@extends('layout.main')

@section('title', 'EDIT EMPLOYEES')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        @include('include.navbar')
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">EDIT EMPLOYEE</h5>
                <form action="/employee/update/{{ $employee->employee_id }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name">FIRST NAME</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}" />
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name">MIDDLE NAME</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name', $employee->middle_name) }}" />
                                @error('middle_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name">LAST NAME</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}" />
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="suffix_name">SUFFIX NAME</label>
                                <input type="text" class="form-control" name="suffix_name" id="suffix_name" value="{{ old('suffix_name', $employee->suffix_name) }}" />
                                @error('suffix_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender">GENDER</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option value="">N/A</option>
                                    <option value="{{ $employee->gender_id }}" selected hidden>{{ $employee->gender }}</option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                        @if (old('gender') == $gender->gender_id)
                                            <option value="{{ $gender->gender_id }}" selected hidden>{{ $gender->gender }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth_date">BIRTH DATE</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date', $employee->birth_date) }}" />
                                @error('birth_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address">ADDRESS</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $employee->address) }}" />
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="contact_number">CONTACT NUMBER</label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number', $employee->contact_number) }}" />
                                @error('contact_number')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department">DEPARTMENT</label>
                                <select class="form-select" name="department" id="department">
                                    <option value="">N/A</option>
                                    <option value="{{ $employee->department_id }}" selected hidden>{{ $employee->department }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->department_id }}">{{ $department->department }}</option>
                                        @if (old('department') == $department->department_id)
                                            <option value="{{ $department->department_id }}" selected hidden>{{ $department->department }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('department')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="position">POSITION</label>
                                <select class="form-select" name="position" id="position">
                                    <option value="">N/A</option>
                                    <option value="{{ $employee->position_id }}" selected hidden>{{ $employee->position }}</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->position_id }}">{{ $position->position }}</option>
                                        @if (old('position') == $position->position_id)
                                            <option value="{{ $position->position_id }}">{{ $position->position }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('position')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/employees" class="btn btn-primary me-1">BACK</a>
                        <button type="submit" class="btn btn-primary">SAVE EMPLOYEE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
