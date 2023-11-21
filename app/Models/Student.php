<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable // extending authenticable makes it process authentication like login, see config>auth.php
{
    
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'student_osasid';

    protected $fillable = [ // the attributes for creating a model of student
        'student_lname',
        'student_fname',
        'student_mi',
        'student_picture',
        'course_id',
        'email',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function course() { // define relationships between the student
        return $this->belongsTo(Course::class, 'course_id');
    }
}
