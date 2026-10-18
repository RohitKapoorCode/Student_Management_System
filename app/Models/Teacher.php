<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{   

    protected $table = 'teacher';

    protected $fillable=[
        'user_id',
        'fullname',
        'email',
        'phoneno',
        'subject',
        'qualification',
        'salary',
        'address',
        'joiningdate',
        'gender',

    ];
}
