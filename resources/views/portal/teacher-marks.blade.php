@extends('layouts.portal')

@section('title', 'Marks Entry')

@section('content')
<div class="head">
    <h4>{{ $student->fullname }}</h4>
    <p>Class {{ $student->class }} &bull; ID: {{ $student->studentid }}</p>
</div>

<div class="box">
    <h5><i class="bi bi-pencil-square"></i>Marks Entry</h5>
    <div class="body pad">

        {{-- Exam badalne ke liye --}}
        <form method="GET" class="d-flex flex-wrap gap-2 mb-4">
            <select name="exam" class="form-select" style="max-width:220px;">
                @foreach($exams as $e)
                    <option value="{{ $e }}" @selected($e === $exam)>{{ $e }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-soft">Change the exam</button>
        </form>

        <form method="POST" action="{{ route('teacher.marks.store', $student) }}">
            @csrf
            <input type="hidden" name="exam" value="{{ $exam }}">

            <div class="mb-3" style="max-width:220px;">
                <label class="form-label" for="max_marks">Max marks (every subject)</label>
                <input type="number" min="1" max="1000" class="form-control" id="max_marks" name="max_marks"
                       value="{{ old('max_marks', optional($existing->first())->max_marks ?? 100) }}" required>
                @error('max_marks')<span class="text-danger small">{{ $message }}</span>@enderror
            </div>

            <div class="table-responsive">
                <table class="table" style="max-width:560px;">
                    <thead><tr><th>Subject</th><th>Marks obtained</th></tr></thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td class="fw-semibold">{{ $subject }}</td>
                                <td>
                                    <input type="number" step="0.01" min="0" class="form-control" style="max-width:160px;"
                                           name="marks[{{ $subject }}]"
                                           value="{{ old('marks.' . $subject, $existing->get($subject)?->marks_obtained !== null ? $existing->get($subject)->marks_obtained + 0 : '') }}">
                                    @error('marks.' . $subject)<span class="text-danger small">{{ $message }}</span>@enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn-main"><i class="bi bi-check2-circle me-1"></i> Save marks</button>
                <a href="{{ route('teacher.dashboard') }}" class="btn-soft text-decoration-none">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
