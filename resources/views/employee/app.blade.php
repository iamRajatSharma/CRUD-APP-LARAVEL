<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('employee.index') }}">Employee CRUD Application</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-6">
                <h3>{{ $title }}</h3>
            </div>
            <div class="col-lg-6">
                <div style="float: right">
                    <a href="{{ route('employee.index') }}" class="btn btn-success">Home</a>
                    <a  href="{{ route('employee.create') }}" class="btn btn-success">Add New Employee</a>
                </div>
            </div>
        </div>
        @yield('main-section')

    </div>
</body>

</html>
