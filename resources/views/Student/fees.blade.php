<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fees Management</title>

<link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    background: #eef4ff;
    font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
    margin: 0;
    padding: 15px;
    min-height: 100vh;
    color: #253858;
}

/* School Header */
.header-box {
    text-align: center;
    max-width: 900px;
    margin: 0 auto 15px;
    padding: 14px;
    background: #1746a2;
    color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 5px 16px rgba(23, 70, 162, 0.12);
}

.header-box img {
    width: 58px;
    height: 58px;
    object-fit: contain;
    background: #ffffff;
    padding: 4px;
    border-radius: 7px;
}

.header-box h3 {
    margin-top: 7px;
    margin-bottom: 4px;
    font-size: 19px;
    font-weight: 700;
    color: #ffffff;
}

.header-box p {
    margin: 0;
    font-size: 12px;
    color: #dbeafe !important;
}

/* Main Container */
.container-box {
    width: 100%;
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e1e9f7;
    box-shadow: 0 5px 20px rgba(23, 70, 162, 0.08);
}

.container-box h4 {
    font-size: 18px;
    font-weight: 700;
    color: #1746a2;
}

.container-box h5 {
    font-size: 15px;
    font-weight: 700;
    color: #1746a2;
}

/* Total Fees */
.total-box {
    background: #edf4ff;
    border: 1px solid #cbdcff;
    border-left: 4px solid #1746a2;
    padding: 13px 16px;
    border-radius: 7px;
    font-size: 15px;
    font-weight: 700;
    color: #1746a2;
}

/* Form */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #253858;
    margin-bottom: 6px;
}

.form-control {
    min-height: 38px;
    font-size: 13px;
    border: 1px solid #d5deeb;
    border-radius: 6px;
}

.form-control:focus {
    border-color: #1746a2;
    box-shadow: 0 0 0 3px rgba(23, 70, 162, 0.10);
}

/* Buttons */
.btn-primary {
    background: #1746a2;
    border: 1px solid #1746a2;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    padding: 9px 15px;
}

.btn-primary:hover {
    background: #10377f;
    border-color: #10377f;
}

/* Fees Table */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.table {
    margin-bottom: 0;
    font-size: 12px;
    border-color: #e2e8f0;
}

.table th {
    background: #1746a2;
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    padding: 10px;
    white-space: nowrap;
}

.table td {
    padding: 10px;
    vertical-align: middle;
    color: #334155;
}

.table tbody tr:nth-child(even) td {
    background: #f7f9ff;
}

.table tbody tr:hover td {
    background: #edf3ff;
}

.badge {
    font-size: 11px;
    padding: 6px 9px;
    border-radius: 5px;
}

/* Divider */
hr {
    border-color: #dbe5f3;
    margin: 20px 0;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    body {
        padding: 10px;
    }

    .header-box {
        padding: 12px;
    }

    .header-box img {
        width: 48px;
        height: 48px;
    }

    .header-box h3 {
        font-size: 17px;
    }

    .container-box {
        padding: 14px;
    }

    .total-box {
        font-size: 13px;
    }
}

</style>
</head>

<body>


<div class="header-box">
    <img src="{{ asset('images/School logo.png') }}">
    <h3>Sunrise Public School</h3>
    <p class="text-muted">Fees Management System</p>
</div>


<div class="container-box">

    <h4 class="mb-3">💰 Fees Management</h4>

    
    <div class="total-box mb-4">
        Total Fees Collected: ₹ {{ $totalFees }}
    </div>

    
   <form action="{{ route('fees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Select Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->fullname }} (Class {{ $student->class }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary w-100">💵 Collect Fees</button>
    </form>

    <hr>

    
    <h5 class="mb-3">📋 Student Fees Records</h5>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Total Fees</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->fullname }}</td>
            <td>{{ $student->class }}</td>
            <td>₹ {{ $student->totalfees }}</td>
            <td>
                @if($student->paymentstatus == 'Paid')
                    <span class="badge bg-success">Paid</span>
                @else
                    <span class="badge bg-danger">Pending</span>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('Student.student') }}" class="btn btn-primary px-5 py-2">
            Back 
        </a>
    </div>

</div>

</body>
</html>