<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    @vite('resources/sass/app.scss')
</head>

<body>
    {{-- <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand mb-0 h1"><i class="bi-hexagon-fill me-2"></i> Data Master</a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr class="d-lg-none text-white-50">

                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item col-2 col-md-auto"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item col-2 col-md-auto"><a href="{{ route('employees.index') }}" class="nav-link active">Employee List</a></li>
                </ul>

                <hr class="d-lg-none text-white-50">

                <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i class="bi-person-circle me-1"></i> My Profile</a>
            </div>
        </div>
    </nav> --}}

    @extends('layouts.app')
    @section('content')
        <div class="container mt-4">
            <div class="row mb-0">
                <div class="col-lg-9 col-xl-6">
                    <h4 class="mb-3">{{ $pageTitle }}</h4>
                </div>
                <div class="col-lg-3 col-xl-6">
                    <ul class="list-inline mb-0 float-end">
                        <li class="list-inline-item">
                            <a href="{{ route('employees.exportExcel') }}" class="btn btn-outline-success">
                                <i class="bi bi-download me-1"></i> to Excel
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('employees.exportPdf') }}" class="btn btn-outline-danger">
                                <i class="bi bi-download me-1"></i> to PDF
                            </a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Create Employee
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="table-responsive border p-3 rounded-3">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="employeeTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                    </thead>
                    {{-- <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->firstname }}</td>
                                <td>{{ $employee->lastname }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ $employee->position->name }}</td>
                                <td>@include('employee.actions')</td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
            @push('scripts')
            <script type="module">
                $(document).ready(function() {
                    $("#employeeTable").DataTable({
                        serverSide: true,
                        processing: true,
                        ajax: "/getEmployees",
                        columns: [
                            { data: "id", name: "id", visible: false },
                            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                            { data: "firstname", name: "firstname" },
                            { data: "lastname", name: "lastname" },
                            { data: "email", name: "email" },
                            { data: "age", name: "age" },
                            { data: "position.name", name: "position.name" },
                            { data: "actions", name: "actions", orderable: false, searchable: false },
                        ],
                        order: [[0, "desc"]],
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"],
                        ],
                    });
                    $(".datatable").on("click", ".btn-delete", function (e) {
                        e.preventDefault();

                        var form = $(this).closest("form");
                        var name = $(this).data("name");

                        Swal.fire({
                            title: "Are you sure want to delete\n" + name + "?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "bg-primary",
                            confirmButtonText: "Yes, delete it!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            </script>
            @endpush
        </div>
    @endsection

    @vite('resources/js/app.js')
</body>

</html>
