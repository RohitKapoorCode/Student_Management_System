<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherAuthController extends Controller
{
    public function showloginForm()
    {
        return view('auth.teacherlogin');
    }

    public function showRegisterForm()
    {
        return view('auth.teacherregister');
    }
}