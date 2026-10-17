<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Teacher aur student ke logins manage karna
    public function accounts()
    {
        // 1. Saare teachers jinka login users table me role 'teacher' ke sath bana hai
        $teachersWithLogin = User::where('role', 'teacher')->orderBy('name')->get();

        // 2. Students without login
        $studentsWithoutLogin = Student::whereNull('login_user_id')
            ->orderBy('fullname')
            ->get(['id', 'fullname', 'email', 'class']);

        // 3. Teachers without login (teacher table se wo jinki email users table me nahi hai)
        $teacherLoginEmails = $teachersWithLogin->pluck('email')->map(fn ($e) => strtolower($e))->all();

        $teachersWithoutLogin = collect($this->teacherRecords())
            ->reject(fn ($t) => in_array(strtolower($t['email']), $teacherLoginEmails, true))
            ->values();

        // 4. Students with login
        $studentsWithLogin = Student::with('loginUser:id,email')
            ->whereNotNull('login_user_id')
            ->orderBy('fullname')
            ->get(['id', 'fullname', 'class', 'login_user_id']);

        return view('portal.admin-accounts', [
            'teachersWithLogin'    => $teachersWithLogin,
            'teachersWithoutLogin' => $teachersWithoutLogin,
            'studentsWithLogin'    => $studentsWithLogin,
            'studentsWithoutLogin' => $studentsWithoutLogin,
            'studentLoginCount'    => Student::whereNotNull('login_user_id')->count(),
        ]);
    }

    // Teacher ka login: 'Add Teacher' se bane record me se chuno + password do
    public function storeTeacher(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => ['required', 'integer'],
            'password'   => ['required', 'string', 'min:8'],
        ]);

        $record = collect($this->teacherRecords())->firstWhere('id', (int) $data['teacher_id']);

        if (! $record) {
            return back()->withErrors(['teacher_id' => 'The teachers record could not be found, or their email field is empty.']);
        }

        if (User::where('email', $record['email'])->exists()) {
            return back()->withErrors(['teacher_id' => 'An account for this email already exists.']);
        }

        $user = new User([
            'name'     => $record['name'],
            'email'    => $record['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->role = 'teacher';
        $user->save();

        return back()->with('success', $record['name'] . ' Created a Teacher Login');
    }

    public function destroyStudent($id)
    {
        // User table se user dhundho jiska role 'student' ho
        $user = User::where('role', 'student')->where('id', $id)->firstOrFail();
        
        // Student table me jiska login_user_id yeh hai, use null kar do
        Student::where('login_user_id', $user->id)->update(['login_user_id' => null]);
        
        // User account delete kar do
        $user->delete();

        return back()->with('success', 'Student ka login hata diya.');
    }

    // 'teacher' table se (id, naam, email) padhta hai. Column ke naam khud pehchanta hai.
    private function teacherRecords(): array
    {
        if (! Schema::hasTable('teacher')) {
            return [];
        }

        $cols   = Schema::getColumnListing('teacher');
        $nameCol = collect(['fullname', 'name', 'teachername', 'teacher_name'])
            ->first(fn ($c) => in_array($c, $cols, true));

        if (! $nameCol || ! in_array('email', $cols, true)) {
            return [];
        }

        return DB::table('teacher')
            ->select('id', $nameCol . ' as name', 'email')
            ->whereNotNull('email')
            ->orderBy($nameCol)
            ->get()
            ->map(fn ($r) => ['id' => (int) $r->id, 'name' => $r->name, 'email' => $r->email])
            ->all();
    }

    public function destroyTeacher($id)
    {
        // User table se role teacher aur id match karke delete karein
        $user = User::where('role', 'teacher')->where('id', $id)->firstOrFail();
        $user->delete();

        return back()->with('success', 'Teacher ka login hata diya.');
    }

    public function storeStudentLogin(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:student,id'],
            'password'   => ['required', 'string', 'min:8'],
        ]);

        $student = Student::findOrFail($data['student_id']);

        if (User::where('email', $student->email)->exists()) {
            return back()->withErrors(['student_id' => 'An account for this email already exists.']);
        }

        $user = new User([
            'name'     => $student->fullname,
            'email'    => $student->email,
            'password' => Hash::make($data['password']),
        ]);
        $user->role = 'student';
        $user->save();

        // is login ko student ke record se jod do
        $student->update(['login_user_id' => $user->id]);

        return back()->with('success', $student->fullname . ' The login has been created.');
    }

    // Teacher / student ka naya password set karna (admin batata hai)
    public function resetPassword(Request $request, User $user)
    {
        abort_unless(in_array($user->role, ['teacher', 'student'], true), 404);

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user->password = Hash::make($data['password']);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return back()->with('success', $user->name . ' A new password has been set. Now, let them know what this password is.');
    }

    // Saare students ke marks ek jagah
    public function marks(Request $request)
    {
        $classes = Student::query()->distinct()->orderBy('class')->pluck('class');

        $marks = Mark::with('student:id,fullname,studentid,class')
            ->when($request->filled('exam'), fn ($q) => $q->where('exam', $request->exam))
            ->when($request->filled('class'), fn ($q) => $q->whereHas('student', fn ($s) => $s->where('class', $request->class)))
            ->latest()
            ->limit(300)
            ->get();

        return view('portal.admin-marks', [
            'marks'   => $marks,
            'classes' => $classes,
            'exams'   => TeacherMarksController::EXAMS,
        ]);
    }
}