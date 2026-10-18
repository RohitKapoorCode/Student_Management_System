@extends('layouts.portal')

@section('title', 'Teacher & Student Logins')

@section('content')
<div class="head">
    <h4>Teacher &amp; Student Logins</h4>
    <p>Create a login here, then share the email and password with the teacher/student.</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
    </div>
@endif

<div class="row g-4">
    {{-- ================= STUDENTS ================= --}}
    <div class="col-lg-6">
        <div class="box">
            <h5><i class="bi bi-mortarboard"></i>Student Logins</h5>
            <div class="body pad">

                @if($studentsWithoutLogin->isEmpty())
                    <div class="empty" style="padding:14px;">Login accounts have been created for all students.</div>
                @else
                    <form method="POST" action="{{ route('admin.studentlogins.store') }}" class="mb-4">
                        @csrf
                        <label class="form-label" for="student_id">Select 'Student' to create a login.</label>
                        <select name="student_id" id="student_id" class="form-select mb-2" required>
                            <option value="">Select Student</option>
                            @foreach($studentsWithoutLogin as $s)
                                <option value="{{ $s->id }}">{{ $s->fullname }} (Class {{ $s->class }}) - {{ $s->email }}</option>
                            @endforeach
                        </select>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password (min 8)" required>
                        <div class="form-text mb-2">The login email will be the same as the one in the student's record. Please provide this email and password to the student.</div>
                        <button type="submit" class="btn-main"><i class="bi bi-key me-1"></i> Create a student login</button>
                    </form>
                @endif

                <div class="table-responsive">
    <table class="table">
        <thead><tr><th>Student</th><th>Login email</th><th>New password</th><th></th></tr></thead>
        <tbody>
            @forelse($studentsWithLogin as $s)
                <tr>
                    <td class="fw-semibold">{{ $s->fullname }}<br><span class="pill">Class {{ $s->class }}</span></td>
                    <td>{{ $s->loginUser->email ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.password', $s->login_user_id) }}" class="d-flex gap-1">
                            @csrf @method('PUT')
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="Min 8" required style="min-width:110px;">
                            <button class="btn btn-sm btn-outline-primary">Set</button>
                        </form>
                    </td>
                    <td class="text-end">
                        <form method="POST" action="{{ route('admin.studentlogins.destroy', $s->login_user_id) }}" onsubmit="return confirm('Remove this students login.?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">No student login has been created yet..</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>

{{-- ================= TEACHERS ================= --}}
<div class="col-lg-6">
    <div class="box">
        <h5><i class="bi bi-person-workspace"></i>Teacher Logins</h5>
        <div class="body pad">

            @if($teachersWithoutLogin->isEmpty())
                <div class="empty" style="padding:14px;">Login accounts have been created for all teachers.</div>
            @else
                <form method="POST" action="{{ route('admin.teachers.store') }}" class="mb-4">
                    @csrf
                    <label class="form-label" for="teacher_id">Select 'Teacher' to create a login.</label>
                    <select name="teacher_id" id="teacher_id" class="form-select mb-2" required>
                        <option value="">Select Teacher</option>
                        @foreach($teachersWithoutLogin as $t)
                            <option value="{{ $t['id'] }}">{{ $t['name'] ?? $t['fullname'] }} - {{ $t['email'] }}</option>
                        @endforeach
                    </select>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password (min 8)" required>
                    <div class="form-text mb-2">The login email will be the same as the one in the teacher's record. Please provide this email and password to the teacher.</div>
                    <button type="submit" class="btn-main"><i class="bi bi-key me-1"></i> Create a teacher login</button>
                </form>
            @endif

           <div class="table-responsive">
    <table class="table">
        <thead><tr><th>Teacher</th><th>Login email</th><th>New password</th><th></th></tr></thead>
        <tbody>
            @forelse($teachersWithLogin as $t)
                <tr>
                    <td class="fw-semibold">{{ $t->name }}<br><span class="pill">Teacher</span></td>
                    <td>{{ $t->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.password', $t->id) }}" class="d-flex gap-1">
                            @csrf @method('PUT')
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="Min 8" required style="min-width:110px;">
                            <button class="btn btn-sm btn-outline-primary">Set</button>
                        </form>
                    </td>
                    <td class="text-end">
                        <form method="POST" action="{{ route('admin.teachers.destroy', $t->id) }}" onsubmit="return confirm('Is teacher ka login hata dein?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">No teacher login has been created yet..</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
@endsection
