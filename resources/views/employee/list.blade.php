@extends('employee.app')
@section('title')
    {{ $title }}
@endsection
@section('main-section')
    <div class="row mt-3">
        <div class="col-lg-12">
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('type') }}">
                <strong>{{ Session::get('message') }}</strong></div>
            @endif

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($employees) > 0)
                        @foreach ($employees as $key => $employee)
                            <tr valign="middle">
                                <td>{{ ++$key }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->mobile }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>
                                    @if ($employee->image != '' && file_exists(public_path('/uploads/employees/' . $employee->image)))
                                        <img style="width: 50px;" src="{{ url('/uploads/employees/' . $employee->image) }}"
                                            alt="" title="Original Image">
                                    @else
                                        <img style="width: 50px;" src="{{ url('/uploads/employees/dumy.png') }}"
                                            title="Dumy Image" alt="">
                                    @endif
                                </td>
                                <td style="width: 150px;">
                                    <a style="float: left;" href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button style="float: right" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><strong>No Data Found</strong></td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $employees->links() }}
        </div>
    </div>

@endsection
