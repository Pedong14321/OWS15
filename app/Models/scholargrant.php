<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scholargrant extends Model
{
    use HasFactory;
    protected $fillable = [
        'Lname',
        'Fname',
        'Mname',
        'program',
        'type',
        'Yrlevel',
        'studentemail',
        'studentId',
        'status',
        'contact',
    ];
}
