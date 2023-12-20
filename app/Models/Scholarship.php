<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'provider',
        'description',
        'requirements',
        'qualifications',
        'benefits',
        'archived'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_scholarship', 'scholarship_id', 'student_id');
    }
}
