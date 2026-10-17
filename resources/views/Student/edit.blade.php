<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Update Form </title>

<link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    background: #eef4ff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    min-height: 100vh;
}

/* Form ko center mein rakhna */
.container {
    max-width: 100% !important;
}

body > .container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 25px;
    padding-bottom: 25px;
}

/* Form width */
body > .container > .row {
    width: 100%;
    margin: 0;
}

body > .container > .row > div {
    max-width: 900px;
}

/* Card design */
.card {
    border-radius: 12px;
    border: none;
    overflow: hidden;
    box-shadow: 0 8px 28px rgba(23, 70, 162, 0.12);
}

.card-header {
    background: #1746a2;
    color: white;
    padding: 14px 20px;
}

.card-body {
    padding: 22px;
}

.form-label {
    font-weight: 600;
    font-size: 13px;
    color: #253858;
    margin-bottom: 5px;
}

.form-control {
    min-height: 37px;
    font-size: 13px;
    border-radius: 6px;
}

.form-control:focus {
    border-color: #1746a2;
    box-shadow: 0 0 0 2px rgba(23, 70, 162, 0.12);
}

.btn-primary {
    background: #1746a2;
    border-color: #1746a2;
}

.btn-primary:hover {
    background: #10377f;
    border-color: #10377f;
}

@media (max-width: 767px) {
    body > .container {
        padding: 18px 12px;
    }

    .card-body {
        padding: 16px;
    }
}

</style>

</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10">

            <div class="card shadow">

                <!-- Header -->
                <div class="card-header d-flex align-items-center gap-2">
                    <img src="{{ asset('images/School logo.png') }}" height="40">
                    <h5 class="mb-0 fw-semibold">Student Updation Form</h5>
                </div>

                <div class="card-body">

<form method="POST" action="{{route('Student.update',['student'=> $student])}}">
@csrf
@method('put')
<div class="row">

    <!-- Left Column -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control"  value="{{$student->fullname}}"required>
        </div>
        <div class="mb-3">
            <div class="mb-3">
            <label class="form-label">Student ID</label>

            <input
                type="text"
                name="studentid"
                class="form-control"
                value="{{ old('studentid', $student->studentid) }}"
                readonly
            >
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dateofbirth" class="form-control"  value="{{$student->dateofbirth}}"required>
        </div>

        <div class="mb-3">
            <label class="form-label">Father Name</label>
            <input type="text" name="fathername" class="form-control" value="{{$student->fathername}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mother Name</label>
            <input type="text" name="mothername" class="form-control" value="{{$student->mothername}}">
        </div>

       <select name="class" class="form-control">
            <option value="">Select Class</option>
            @foreach(['5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th'] as $class)
            <option value="{{ $class }}"
            {{ old('class', $student->class) == $class ? 'selected' : '' }}>
            {{ $class }}
            </option>
        @endforeach
        </select>

    </div>

    <!-- Right Column -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Parent Phone</label>
            <input type="text" name="parentphone" class="form-control" value="{{$student->parentphone}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Student Phone</label>
            <input type="text" name="studentphone" class="form-control" value="{{$student->studentphone}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{$student->email}}">
        </div>
        <input type="radio" name="gender" value="Male"
        {{ old('gender', $student->gender) == 'Male' ? 'checked' : '' }}>
            Male

        <input type="radio" name="gender" value="Female"
            {{ old('gender', $student->gender) == 'Female' ? 'checked' : '' }}>
            Female
        <textarea name="address" class="form-control" rows="2">{{ old('address', $student->address) }}</textarea>

    </div>

</div>

<hr>

<!-- Fees in one row -->
<div class="row">

    <div class="col-md-3">
        <label>Admission Fees</label>
        <input type="number" name="admissionfees" class="form-control" value="{{$student->admissionfees}}">
    </div>

    <div class="col-md-3">
        <label>Tuition Fees</label>
        <input type="number" name="tuitionfees" class="form-control" value="{{$student->tuitionfees}}">
    </div>

    <div class="col-md-3">
        <label>Total Fees</label>
        <input type="number" name="totalfees" class="form-control" value="{{$student->totalfees}}">
    </div>
    <div class="col-md-3 ">
                <label >Payment Status</label>
                <select name="paymentstatus" class="form-control">
                    <option value="Paid">Paid</option>
                    <option value="Unpaid" selected>Unpaid</option>
                </select>
    </div>
</select>
    <td>
</td>

</div>

<!-- Buttons -->
<div class="mt-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('Student.student')}}" class="btn btn-secondary">Back</a>
</div>

</form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>