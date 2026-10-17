<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class studentcontroller extends Controller
{
    // Student list (admin ko SAB students dikhte hain, khud register hue bhi)
    public function student()
{
    // Total Students
    $totalStudent = \App\Models\student::count();

    // Active Students
    $activeStudent = \App\Models\student::count();

    // New Admissions This Month
    $newAdmission = \App\Models\student::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    // Total Fees Paid
    $totalFees = \App\Models\student::whereIn('paymentstatus', ['Paid', 'paid', '1'])
        ->sum('totalfees');

    // Total Teachers
    $totalTeacher = \App\Models\teacher::count();

    // Student Records
    $student = \App\Models\student::latest()->get();

    return view('Student.student', compact(
        'totalStudent',
        'activeStudent',
        'newAdmission',
        'totalFees',
        'student',
        'totalTeacher'
    ));
}
    // Show create page
    public function create()
    {
        return view('Student.create');
    }


    public function viewstudent()
    {
        $student = Student::orderBy('fullname')->get();

        return view('Student.viewstudent', compact('student'));
    }
    // Save student
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $data['user_id'] = auth()->id();

        Student::create($data);

        return redirect()->route('student.viewstudent')
        ->with('success', 'Student added successfully!');
    }

    // Edit student
    public function edit(Student $student)
    {
        return view('Student.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $student->update($request->validate($this->rules()));

        return redirect()->route('student.viewstudent')
        ->with('success', 'Student added successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.viewstudent')
        ->with('success', 'Student added successfully!');
    }

    private function rules(): array
    {
        return [
            'fullname'      => 'required|string|max:255',
            'studentid'     => 'required|string|max:255',
            'dateofbirth'   => 'required|date',
            'fathername'    => 'required|string|max:255',
            'mothername'    => 'required|string|max:255',
            'class'         => 'required|string|max:255',
            'parentphone'   => 'required|string|max:20',
            'studentphone'  => 'required|string|max:20',
            'email'         => 'required|email|max:255',
            'gender'        => 'required|string|max:20',
            'address'       => 'required|string',
            'admissionfees' => 'required|numeric|min:0',
            'tuitionfees'   => 'required|numeric|min:0',
            'totalfees'     => 'required|numeric|min:0',
            'paymentstatus' => 'required|string|max:50',
        ];
    }
}
