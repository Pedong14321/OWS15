<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecords extends Model
{
    use HasFactory;

    protected $primaryKey = 'attendance_id';

    protected $fillable = [
        'student_osasid',
        'event_id',
        'time_in',
        'time_out',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_osasid', 'student_osasid');
    }
    public function event()
    {
        return $this->belongsTo(StudentEvent::class, 'event_id', 'event_id');
    }

    public function getLastCreatedDateAttribute()
    {
        // Assuming 'last_updated' is a timestamp or datetime column
        $created_at = $this->attributes['created_at'];

        // Convert to DateTime object if it's a string
        if (is_string($created_at)) {
            $created_at = new \DateTime($created_at);
        }

        return $created_at->format('Y-m-d');
    }
    public function getLastCreatedTimeAttribute()
    {
        // Assuming 'last_updated' is a timestamp or datetime column
        $created_at = $this->attributes['created_at'];

        // Convert to DateTime object if it's a string
        if (is_string($created_at)) {
            $created_at = new \DateTime($created_at);
        }

        return $created_at->format('H:i:s');
    }
}
