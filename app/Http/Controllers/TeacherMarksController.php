<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherMarksController extends Controller
{
    public const EXAMS = ['Unit Test', 'Half Yearly', 'Annual'];
    public const SUBJECTS = ['English', 'Hindi', 'Mathematics', 'Science', 'Social Science'];

    // Students ki list (fees wagairah teacher ko nahi dikhte)
    public function index(Request $request)
    {
        $classes = Student::query()->distinct()->orderBy('class')->pluck('class');

        $students = Student::query()
            ->when($request->filled('class'), fn ($q) => $q->where('class', $request->class))
            ->when($request->filled('q'), fn ($q) => $q->where('fullname', 'like', '%' . $request->q . '%'))
            ->orderBy('class')
            ->orderBy('fullname')
            ->get(['id', 'fullname', 'studentid', 'class']);

        return view('portal.teacher-students', compact('students', 'classes'));
    }

    // Marks form
    public function create(Request $request, Student $student)
    {
        $exam = in_array($request->exam, self::EXAMS, true) ? $request->exam : self::EXAMS[0];

        $existing = $student->marks()->where('exam', $exam)->get()->keyBy('subject');

        return view('portal.teacher-marks', [
            'student'  => $student,
            'exams'    => self::EXAMS,
            'subjects' => self::SUBJECTS,
            'exam'     => $exam,
            'existing' => $existing,
        ]);
    }

    // Marks save / update
   public function store(Request $request, Student $student)
{
    $data = $request->validate([
        'exam'      => ['required', Rule::in(self::EXAMS)],
        'max_marks' => ['required', 'integer', 'min:1'],
        'marks'     => ['required', 'array'],
        'marks.*'   => ['nullable', 'integer', 'min:0', 'lte:max_marks'],
    ]);

    foreach ($data['marks'] as $subject => $value) {
        if ($value === null || $value === '') {
            continue;
        }

        if (!in_array($subject, self::SUBJECTS, true)) {
            continue;
        }

        Mark::updateOrCreate(
            [
                'student_id' => $student->id,
                'exam'       => $data['exam'],
                'subject'    => $subject,
            ],
            [
                'max_marks'  => $data['max_marks'],
                'marks'      => $value,
                'teacher_id' => auth()->id(),
            ]
        );
    }

    return redirect()->route('teacher.dashboard')
        ->with('success', 'Marks successfully save ho gaye hain!');
}
};