<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Registration</title>

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
                    <h5 class="mb-0 fw-semibold">Student Registration Form</h5>
                </div>

                <div class="card-body">

<form method="POST" action="{{route('Student.store')}}">
@csrf

<div class="row">

    <!-- Left Column -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Student_Id</label>
            <input type="text" name="studentid" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dateofbirth" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Father Name</label>
            <input type="text" name="fathername" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mother Name</label>
            <input type="text" name="mothername" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class" class="form-control">
                <option value="">Select Class</option>
                <option value="5th">5th</option>
                <option value="6th">6th</option>
                <option value="7th">7th</option>
                <option value="8th">8th</option>
                <option value="9th">9th</option>
                <option value="10th">10th</option>
            </select>
        </div>

    </div>

    <!-- Right Column -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Guardian Phone</label>
            <input type="text" name="parentphone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Student Phone</label>
            <input type="text" name="studentphone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <input type="radio" name="gender" value="Male"> Male
            <input type="radio" name="gender" value="Female"> Female
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2"></textarea>
        </div>

    </div>

</div>

<hr>

<!-- Fees in one row -->
            <!-- Fees in one row -->
        <div class="row">

            <div class="col-md-4">
                <label class="form-label">Admission Fees</label>
                <input type="number" id="admissionfees"
                    name="admissionfees" class="form-control"
                    min="0" step="0.01" value="0">
            </div>

            <div class="col-md-4">
                <label class="form-label">Tuition Fees</label>
                <input type="number" id="tuitionfees"
                    name="tuitionfees" class="form-control"
                    min="0" step="0.01" value="0">
            </div>

            <div class="col-md-4">
                <label class="form-label">Total Fees</label>
                <input type="number" id="totalfees"
                    name="totalfees" class="form-control"
                    readonly>
            </div>

            <div class="col-md-3 mt-3">
                <label class="form-label">Payment Status</label>
                <select name="paymentstatus" class="form-control">
                    <option value="Paid">Paid</option>
                    <option value="Unpaid" selected>Unpaid</option>
                </select>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/viewstudent') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Students
</a>
        </div>  

</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const admissionFees = document.getElementById('admissionfees');
    const tuitionFees = document.getElementById('tuitionfees');
    const totalFees = document.getElementById('totalfees');

    function calculateTotalFees() {
        const admission = parseFloat(admissionFees.value) || 0;
        const tuition = parseFloat(tuitionFees.value) || 0;

        totalFees.value = (admission + tuition).toFixed(2);
    }

    admissionFees.addEventListener('input', calculateTotalFees);
    tuitionFees.addEventListener('input', calculateTotalFees);

    calculateTotalFees();
</script>
           
</body>
</html>