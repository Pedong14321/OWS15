<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoGrantStatus extends Model
{
    use HasFactory;
    public function scholarships()
    {
        return $this->hasMany(StudentScholarship::class, 'status_id');
    }
}
