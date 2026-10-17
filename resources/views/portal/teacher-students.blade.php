@extends('layouts.portal')

@section('title', 'Students & Marks')

@section('content')
<div class="head">
    <h4>Students &amp; Marks</h4>
    <p>Select a student and enter their marks.</p>
</div>

<div class="box">
    <h5><i class="bi bi-journal-check"></i>Students</h5>
    <div class="body pad">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <select name="class" class="form-select">
                    <option value="">All classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" @selected(request('class') == $c)>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5"><input type="text" name="q" class="form-control" placeholder="Student ka naam" value="{{ request('q') }}"></div>
            <div class="col-md-3"><button class="btn-main w-100" type="submit"><i class="bi bi-search me-1"></i> Filter</button></div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Student ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td class="fw-semibold">{{ $student->fullname }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->studentid ?? '-' }}</td>
                            <td>
                                <a href="{{ route('teacher.marks.create', $student->id) }}" class="btn btn-sm btn-outline-primary">Enter Marks</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty">No students found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection