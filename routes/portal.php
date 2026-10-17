<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleLoginController;
use App\Http\Controllers\StudentPortalController;
use App\Http\Controllers\TeacherMarksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 3 alag login: student / teacher / admin
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::view('/login', 'student-login')->name('login');
    Route::post('/login', [RoleLoginController::class, 'login'])
        ->defaults('role', 'student');

    Route::view('/teacher/login', 'teacher-login')->name('teacherlogin');
    Route::post('/teacher/login', [RoleLoginController::class, 'login'])
        ->defaults('role', 'teacher');

    Route::view('/admin/login', 'admin-login')->name('adminlogin');
    Route::post('/admin/login', [RoleLoginController::class, 'login'])
        ->defaults('role', 'admin');
});

/*
|--------------------------------------------------------------------------
| STUDENT: sirf apna personal dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/my-dashboard', [StudentPortalController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/my-profile', [StudentPortalController::class, 'saveProfile'])->name('student.profile.save');
});

/*
|--------------------------------------------------------------------------
| TEACHER: sirf marks daalna
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', [TeacherMarksController::class, 'index'])->name('dashboard');
    Route::get('/marks/{student}', [TeacherMarksController::class, 'create'])->name('marks.create');
    Route::post('/marks/{student}', [TeacherMarksController::class, 'store'])->name('marks.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN: teachers aur students ke logins + saare marks
| (students, fees, exam wale purane routes bhi 'role:admin' group me daalo)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/accounts', [AdminController::class, 'accounts'])->name('accounts');
    Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
    Route::delete('/teachers/{user}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');
    Route::post('/student-logins', [AdminController::class, 'storeStudentLogin'])->name('studentlogins.store');
    Route::get('/marks', [AdminController::class, 'marks'])->name('marks');
    Route::put('/users/{user}/password', [AdminController::class, 'resetPassword'])->name('users.password');
});
// Logout karke Student Login par bhejo
Route::post('/logout-to-student', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout.student');

// Logout karke Teacher Login par bhejo
Route::post('/logout-to-teacher', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('teacherlogin');
})->middleware('auth')->name('logout.teacher');

// Logout karke Admin Login par bhejo
Route::post('/logout-to-admin', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('adminlogin');
})->middleware('auth')->name('logout.admin');

