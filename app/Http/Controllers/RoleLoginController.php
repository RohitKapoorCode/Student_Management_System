<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleLoginController extends Controller
{
    // login ke baad har role kahan jayega
    private const HOME = [
        'student' => 'student.dashboard',
        'teacher' => 'teacher.dashboard',
        'admin'   => 'Student.student',
    ];

    public function login(Request $request, string $role): RedirectResponse
    {
        abort_unless(isset(self::HOME[$role]), 404);

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // role bhi match hona chahiye: teacher, student login page se login nahi kar sakta
        if (Auth::attempt($credentials + ['role' => $role], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route(self::HOME[$role]);
        }

        return back()
            ->withErrors(['email' => 'The email or password is incorrect, or these ' . $role . ' There is no account.'])
            ->onlyInput('email');
    }
}
