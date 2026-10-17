<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Teacher Update From </title>

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
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px 12px;
}

/* Center Form */
.form-wrapper {
    width: 100%;
    max-width: 900px;
    margin: auto;
}

/* Card */
.card {
    border-radius: 12px;
    border: none;
    overflow: hidden;
    box-shadow: 0 8px 28px rgba(23, 70, 162, 0.12);
}

/* Royal Blue Header */
.card-header {
    background: #1746a2;
    color: white;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    background: white;
    border-radius: 6px;
    padding: 2px;
}

.card-header h5 {
    font-size: 17px;
    font-weight: 650;
    margin: 0;
}

/* Compact Form Body */
.card-body {
    padding: 22px 25px;
}

/* Section Headings */
.section-title {
    color: #1746a2;
    font-size: 13px;
    font-weight: 700;
    padding-bottom: 8px;
    margin-bottom: 16px;
    border-bottom: 1px solid #e2e8f0;
}

/* Labels */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #253858;
    margin-bottom: 5px;
}

/* Inputs */
.form-control,
.form-select {
    min-height: 37px;
    font-size: 13px;
    border: 1px solid #d5deeb;
    border-radius: 6px;
    padding: 7px 10px;
}

textarea.form-control {
    min-height: 60px;
}

/* Focus */
.form-control:focus,
.form-select:focus {
    border-color: #1746a2;
    box-shadow: 0 0 0 2px rgba(23, 70, 162, 0.12);
}

/* Buttons */
.btn {
    font-size: 13px;
    padding: 9px 17px;
    border-radius: 6px;
}

.btn-primary {
    background: #1746a2;
    border-color: #1746a2;
}

.btn-primary:hover {
    background: #10377f;
    border-color: #10377f;
}

/* Bottom Buttons */
.button-row {
    border-top: 1px solid #e2e8f0;
    padding-top: 16px;
    margin-top: 6px;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    body {
        padding: 15px 10px;
    }

    .card-body {
        padding: 17px;
    }

    .card-header {
        padding: 12px 15px;
    }
}

</style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10">

            <div class="card shadow">

                <div class="card-header d-flex align-items-center gap-2">
                    <img src="{{ asset('images/School logo.png') }}" height="40">
                    <h5 class="mb-0 fw-semibold">Teacher Updation Form </h5>
                </div>

                <div class="card-body">
        <form  method="POST" action="{{route('teacher.update',$teacher->id)}}">
            @csrf
            @method('PUT')
            <div class="row">

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter full name"  value="{{$teacher->fullname}}" required>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{$teacher->email}}" required>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phoneno" class="form-control" value="{{$teacher->phoneno}}" placeholder="Enter phone number">
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" value="{{$teacher->subject}}" placeholder="e.g. Math, Science">
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{$teacher->qualification}}"  placeholder="e.g. B.Ed, M.Sc">
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Salary</label>
                    <input type="number" name="salary" class="form-control"  value="{{$teacher->salary}}" placeholder="Enter salary">
                </div>

                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"  value="{{$teacher->address}}"placeholder="Enter address"></textarea>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Joining Date</label>
                    <input type="date" name="joiningdate" class="form-control" value="{{$teacher->joiningdate}}">
                </div>

                
              <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <input type="radio" name="gender" value="Male" value="{{$teacher->gender}}"> Male
                    <input type="radio" name="gender" value="Female" value="{{$teacher->gender}}"> Female
        </div>

            </div>

            
            <div class="d-flex justify-content-end mt-3">
                
                    <a href="{{route('Student.student')}}" class="btn btn-secondary me-2"><i class="bi bi-arrow-counterclockwise"></i> Back</a>
                
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i> Submit
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>