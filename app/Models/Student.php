<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = [
        'user_id',
        'login_user_id',
        'fullname',
        'studentid',
        'dateofbirth',
        'fathername',
        'mothername',
        'class',
        'parentphone',
        'studentphone',
        'email',
        'gender',
        'address',
        'admissionfees',
        'tuitionfees',
        'totalfees',
        'paymentstatus',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Student ka apna login account
    public function loginUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'login_user_id');
    }

    // Teacher ke daale hue marks
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}
