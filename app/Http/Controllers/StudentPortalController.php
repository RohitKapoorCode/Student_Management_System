<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentPortalController extends Controller
{
    // Student ka personal dashboard (sirf apna record)
    public function dashboard()
    {
        $student = Student::with('marks')->where('login_user_id', auth()->id())->first();

        $results = $student
            ? $student->marks->groupBy('exam')->map(function ($rows) {
                $max = $rows->sum('max_marks');
                $got = $rows->sum('marks'); // <-- yahan 'marks_obtained' ki jagah 'marks' kar do
                $pct = $max ? round($got / $max * 100, 1) : 0;

                return [
                    'rows'  => $rows,
                    'max'   => $max,
                    'got'   => $got,
                    'pct'   => $pct,
                    'grade' => Mark::gradeFor($pct),
                    'pass'  => $rows->every(fn ($m) => $m->marks >= $m->max_marks * 0.33), // <-- yahan bhi 'marks_obtained' ki jagah 'marks'
                ];
            })
            : collect();

        return view('portal.student', compact('student', 'results'));
    }

    // Basic details update (naam, DOB, phone, address, parents, gender, email)
    public function saveProfile(Request $request)
    {
        $user = $request->user();

        // record URL se nahi, login wale user se milta hai: doosre ka record chhoo nahi sakta
        $student = Student::where('login_user_id', $user->id)->firstOrFail();

        $data = $request->validate([
            'fullname'     => ['required', 'string', 'max:255'],
            'dateofbirth'  => ['required', 'date', 'before:today'],
            'gender'       => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'fathername'   => ['required', 'string', 'max:255'],
            'mothername'   => ['required', 'string', 'max:255'],
            'studentphone' => ['required', 'string', 'max:20'],
            'parentphone'  => ['required', 'string', 'max:20'],
            'address'      => ['required', 'string', 'max:500'],
            // email badalne par login email bhi badal jata hai; kisi aur ka email nahi le sakte
            'email'        => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        DB::transaction(function () use ($user, $student, $data) {
            $user->name  = $data['fullname'];   // header me dikhne wala naam bhi badal jata hai
            $user->email = $data['email'];
            $user->save();

            // class, student ID, fees, payment status yahan se kabhi nahi badalte
            $student->update($data);
        });

        return redirect()->route('student.dashboard')
            ->with('success', 'Your details have been updated.');
    }
}
