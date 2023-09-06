@extends('employee.app')
@section('title')
    {{ $title }}
@endsection
@section('main-section')
    <div class="row mt-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Create New Employee</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $employee->id }}">
                        <div class="form-group mb-2">
                            <label for=""><strong>Full Name</strong></label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control"
                                value={{ old('name', $employee->name) }}>
                            @error('name')
                                <p class="text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for=""><strong>Email</strong></label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control"
                                value={{ old('name', $employee->email) }}>
                            @error('email')
                                <p class="text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for=""><strong>Mobile</strong></label>
                            <input type="text" name="mobile" placeholder="Enter Mobile" class="form-control"
                                value={{ old('mobile', $employee->mobile) }}>
                            @error('mobile')
                                <p class="text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for=""><strong>Address</strong></label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $employee->address) }}</textarea>
                            @error('address')
                                <p class="text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for=""><strong>Image</strong></label>
                            <input type="file" name="image" placeholder="Enter Name" class="form-control">
                            @if ($employee->image != '' && file_exists(public_path() . '/uploads/employees/' . $employee->image))
                                <img style="width: 100px; margin: 10px 0px;"
                                    src="{{ '/uploads/employees/' . $employee->image }}" alt="">
                                    <input type="hidden" name="oldimage" value="{{ $employee->image }}">
                            @endif
                            @error('image')
                                <p class="text-danger"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-danger mt-2">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
@endsection
