<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Teachers</title>
    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            background: #eef4ff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            color: #253858;
        }

        .main-wrapper {
            width: 100%;
            max-width: 1500px;
            margin: auto;
            padding: 25px 20px;
        }

        /* Royal Blue Header */
        .header-box {
            background: #1746a2;
            color: #fff;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(23, 70, 162, 0.12);
        }

        .logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: #fff;
            border-radius: 6px;
            padding: 3px;
        }

        .title-text {
            font-size: 18px;
            font-weight: 650;
            margin: 0;
        }

        /* Table Card */
        .table-container {
            background: #fff;
            border-radius: 10px;
            padding: 18px;
            border: 1px solid #e1e9f7;
            box-shadow: 0 5px 22px rgba(23, 70, 162, 0.08);
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
            font-size: 13px;
            white-space: nowrap;
            border-color: #e5eaf2;
        }

        .table thead th {
            background: #1746a2;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 12px 10px;
            border: none;
        }

        .table tbody td {
            padding: 11px 10px;
            vertical-align: middle;
            color: #334155;
        }

        .table tbody tr:nth-child(even) td {
            background: #f7f9ff;
        }

        .table tbody tr:hover td {
            background: #edf3ff;
        }

        /* Buttons */
        .btn-primary {
            background: #1746a2;
            border-color: #1746a2;
        }

        .btn-primary:hover {
            background: #10377f;
            border-color: #10377f;
        }

        .btn-warning {
            background: #fff0c2;
            border-color: #f4d37a;
            color: #805b00;
        }

        .btn-warning:hover {
            background: #ffe49a;
            border-color: #edc45b;
            color: #664800;
        }

        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
        }

        .btn-sm {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 5px;
        }

        .btn {
            font-weight: 600;
        }

        /* Back Button */
        .text-center.mt-4 .btn {
            background: #1746a2;
            border-color: #1746a2;
            border-radius: 6px;
            padding: 9px 24px;
            font-size: 13px;
        }

        .text-center.mt-4 .btn:hover {
            background: #10377f;
            border-color: #10377f;
        }

        /* Mobile Responsive */
        @media (max-width: 576px) {
            .main-wrapper {
                padding: 15px 10px;
            }

            .header-box {
                padding: 12px;
            }

            .logo {
                width: 42px;
                height: 42px;
            }

            .title-text {
                font-size: 16px;
            }

            .table-container {
                padding: 10px;
            }
        }

    </style>
</head>

<body>

<div class="main-wrapper">

    <div class="header-box d-flex align-items-center mb-3">
        <img src="{{ asset('images/School logo.png') }}" class="logo me-3">
        <div class="title-text">View Teachers</div>
    </div>

    
    <div class="table-container">
        <table class="table table-hover text-center align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Qualification</th>
                    <th>Salary</th>
                    <th>Address</th>
                    <th>Joining Date</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($teacher as $t)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $t->fullname}}</td>
                    <td>{{ $t->email}}</td>
                    <td>{{ $t->phoneno}}</td>
                    <td>{{ $t->subject}}</td>
                    <td>{{ $t->qualification}}</td>
                    <td>{{ $t->salary}}</td>
                    <td>{{ $t->address}}</td>
                    <td>{{ $t->joiningdate}}</td>
                    <td>{{ $t->gender}}</td>
                    <td>
                        <a href="{{ route('Student.editteacher', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('teacher.delete', $t->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    
   <div class="text-center mt-4">
    <a href="{{ route('Student.student') }}" class="btn btn-primary px-4">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

</div>

</body>
</html>