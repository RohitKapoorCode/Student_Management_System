@extends('layouts.portal')

@section('title', 'All Results')

@section('content')
<div class="head">
    <h4>All Results</h4>
    <p>All marks entered by teachers (latest 300).</p>
</div>

<div class="box">
    <h5><i class="bi bi-file-earmark-bar-graph"></i>Marks</h5>
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
            <div class="col-md-4">
                <select name="exam" class="form-select">
                    <option value="">All exams</option>
                    @foreach($exams as $e)
                        <option value="{{ $e }}" @selected(request('exam') == $e)>{{ $e }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4"><button class="btn-main w-100" type="submit"><i class="bi bi-funnel me-1"></i> Filter</button></div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Student</th><th>Class</th><th>Exam</th><th>Subject</th><th>Marks</th><th>Grade</th></tr></thead>
                <tbody>
                    @forelse($marks as $m)
                        <tr>
                            <td class="fw-semibold">{{ $m->student->fullname ?? '-' }}</td>
                            <td><span class="pill">{{ $m->student->class ?? '-' }}</span></td>
                            <td>{{ $m->exam }}</td>
                            <td>{{ $m->subject }}</td>
                            <td>{{ $m->marks + 0 }} / {{ $m->max_marks + 0 }}</td>
                            <td>{{ $m->grade }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty">No marks have been entered yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
