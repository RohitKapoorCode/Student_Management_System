<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        $students = Student::where('user_id', auth()->id())->get();

        $totalFees = Student::where('user_id', auth()->id())
                    ->where('paymentstatus', 'Paid')
                    ->sum('totalfees');

        return view('Student.fees', compact('students', 'totalFees'));
    }

    public function store(Request $request)
    {
        $student = Student::find($request->student_id);

        $student->update([
            'paymentstatus' => 'Paid'
        ]);

        return back()->with('success', 'Fees Collected Successfully');
    }
}
