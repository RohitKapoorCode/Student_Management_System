<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
     protected $fillable = [
        'student_id',
        'exam',
        'subject',
        'max_marks',
        'marks',
        'teacher_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public static function gradeFor(float $percent): string
    {
        return match (true) {
            $percent >= 90 => 'A+',
            $percent >= 80 => 'A',
            $percent >= 70 => 'B+',
            $percent >= 60 => 'B',
            $percent >= 50 => 'C',
            $percent >= 33 => 'D',
            default        => 'F',
        };
    }

   
   // $mark->grade
    public function getGradeAttribute(): string
    {
        $percent = $this->max_marks ? ($this->marks / $this->max_marks) * 100 : 0;

        return self::gradeFor($percent);
    }
}
