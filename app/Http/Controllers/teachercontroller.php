<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;

class teachercontroller extends Controller
{
    public function create()
    {
        return view('Student.teacher');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname'      => 'required',
            'email'         => 'required',
            'phoneno'       => 'required',
            'subject'       => 'required',
            'qualification' => 'required',
            'salary'        => 'required',
            'address'       => 'required',
            'joiningdate'   => 'required',
            'gender'        => 'required',
        ]);

        $data['user_id'] = auth()->id();

        Teacher::create($data);

        return redirect()->route('Student.viewteacher')->with('success', 'Teacher added successfully');
    }

    public function student()
    {
        $teacher = Teacher::where('user_id', auth()->id())->get();
        return view('Student.viewteacher', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        return view('Student.editteacher', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        $data = $request->validate([
            'fullname'      => 'required',
            'email'         => 'required|email',
            'phoneno'       => 'required',
            'subject'       => 'required',
            'qualification' => 'required',
            'salary'        => 'required|numeric',
            'address'       => 'required',
            'joiningdate'   => 'required',
            'gender'        => 'required',
        ]);

        $teacher->update($data);

        return redirect()->route('Student.viewteacher')->with('success', 'Teacher details updated successfully!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        $teacher->delete();

        return redirect()->route('Student.viewteacher')->with('success', 'Teacher deleted successfully!');
    }

    public function loginsIndex()
    {
        $teacherLoginEmails = User::where('role', 'teacher')
            ->pluck('email')
            ->map(fn ($e) => strtolower($e))
            ->all();

        $teachersWithoutLogin = Teacher::where('user_id', auth()->id())
            ->get()
            ->reject(fn ($t) => in_array(strtolower($t->email), $teacherLoginEmails, true))
            ->values();

        $teachersWithLogin = User::where('role', 'teacher')->orderBy('name')->get();

        return view('portal.admin-accounts', compact('teachersWithoutLogin', 'teachersWithLogin'));
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teacher,id',
            'password'   => 'required|min:8',
        ]);

        $teacher = Teacher::where('user_id', auth()->id())->where('id', $request->teacher_id)->firstOrFail();

        if (User::where('email', $teacher->email)->exists()) {
            return back()->withErrors(['teacher_id' => 'Is email ka user account pehle se bana hua hai.']);
        }

        User::create([
            'name'     => $teacher->fullname,
            'email'    => $teacher->email,
            'password' => bcrypt($request->password),
            'role'     => 'teacher',
        ]);

        return redirect()->back()->with('success', 'Teacher login successfully ban gaya!');
    }
}