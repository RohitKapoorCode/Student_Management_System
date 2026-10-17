<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Student;


class DashboardController extends Controller
{    
        public function Student()
        {
            $studentCount = Student::count(); // total students

            return view('dashboard', compact('studentCount'));
        }
        
        public function examMarks()
        {
            if(Student::count() < 10){
                return redirect()->back()->with('error', 'Minimum 10 students required');
            }

            return view('exam.marks');
        }
}
