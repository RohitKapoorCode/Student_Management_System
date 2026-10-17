<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\studentcontroller;
use App\Http\Controllers\teachercontroller;
use App\Http\Controllers\TeacherMarksController;
use App\Http\Controllers\StudentPortalController; // <- Ye import zaroor add karein
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::delete('/admin/studentlogins/{id}', [AdminController::class, 'destroyStudent'])->name('admin.studentlogins.destroy');

Route::get('/teacher-logins', [teachercontroller::class, 'loginsIndex'])->name('admin.teacherlogins.index');
Route::post('/teacher-logins', [teachercontroller::class, 'storeLogin'])->name('admin.teachers.store');

Route::get('/viewstudent', [studentcontroller::class, 'viewstudent'])
    ->name('student.viewstudent');

// Admin ke saare routes yahan rahenge
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Baaki admin routes...
});

// Teacher ke saare routes yahan rahenge
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherMarksController::class, 'index'])->name('teacher.dashboard');
    // Baaki teacher routes...
});

// Student ke saare routes yahan rahenge
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student', [StudentPortalController::class, 'dashboard'])->name('student.dashboard');
    // Baaki student routes...
});

// /dashboard: role ke hisaab se sahi dashboard par bhej deta hai

Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default   => abort(403, 'Unauthorized role'),
    };
})->middleware('auth')->name('dashboard');


// Purana student personal page ab naye student dashboard par jata hai
Route::get('/student/personal', fn () => redirect()->route('student.dashboard'))
    ->middleware('auth')
    ->name('student.personal');

// STUDENT ke routes (Jahan student apni details khud update kar sake)

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/my-dashboard', [StudentPortalController::class, 'dashboard'])
        ->name('student.dashboard');

    Route::get('/student/edit-profile', [StudentPortalController::class, 'editProfile'])
        ->name('student.profile.edit');

    Route::put('/student/update-profile', [StudentPortalController::class, 'updateProfile'])
        ->name('student.profile.update');
});


// Profile: sab logged-in users ke liye
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ke routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/student', [studentcontroller::class, 'student'])->name('Student.student');
    Route::get('/student/create', [studentcontroller::class, 'create'])->name('Student.create');
    Route::post('/student', [studentcontroller::class, 'store'])->name('Student.store');
    Route::get('/student/{student}/edit', [studentcontroller::class, 'edit'])->name('Student.edit');
    Route::put('/student/{student}', [studentcontroller::class, 'update'])->name('Student.update');
    Route::delete('/student/{student}', [studentcontroller::class, 'destroy'])->name('Student.destroy');

    Route::get('/add-teacher', [teachercontroller::class, 'create'])->name('Student.teacher');
    Route::post('/add-teacher', [teachercontroller::class, 'store'])->name('Student.teacher.store');
    Route::get('/viewteacher', [teachercontroller::class, 'student'])->name('Student.viewteacher');
    Route::get('/edit-teacher/{id}', [teachercontroller::class, 'edit'])->name('Student.editteacher');
    Route::put('/update-teacher/{id}', [teachercontroller::class, 'update'])->name('teacher.update');
    Route::delete('/delete-teacher/{id}', [teachercontroller::class, 'destroy'])->name('teacher.delete');

    Route::get('/events', function () {
        return view('Student.events');
    })->name('Student.events');

    Route::get('/fees', [FeesController::class, 'index'])->name('Student.fees');
    Route::post('/fees/store', [FeesController::class, 'store'])->name('fees.store');
});

require __DIR__.'/portal.php';
require __DIR__.'/auth.php';