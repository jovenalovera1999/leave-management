@extends('layout.main')

@section('title', 'ADD EMPLOYEE')

@section('content')

@include('include.sidebar')

<main id="main">
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">ADD EMPLOYEE</h5>
                <form action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name">FIRST NAME</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" />
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name">MIDDLE NAME</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" />
                                @error('middle_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name">LAST NAME</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" />
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="suffix_name">SUFFIX NAME</label>
                                <input type="text" class="form-control" name="suffix_name" id="suffix_name" value="{{ old('suffix_name') }}" />
                                @error('suffix_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender">GENDER</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option value="" selected>N/A</option>
                                </select>
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth_date">BIRTH DATE</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" />
                                @error('birth_date')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address">ADDRESS</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" />
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="contact_number">CONTACT NUMBER</label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" />
                                @error('contact_number')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department">DEPARTMENT</label>
                                <select class="form-select" name="department" id="department">
                                    <option value="" selected>N/A</option>
                                </select>
                                @error('department')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="position">POSITION</label>
                                <select class="form-select" name="position" id="position">
                                    <option value="" selected>N/A</option>
                                </select>
                                @error('position')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">SAVE EMPLOYEE</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection