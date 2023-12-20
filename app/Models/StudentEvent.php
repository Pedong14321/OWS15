<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentEvent extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'event_desc',
        'event_date',
        'event_time_in',
        'event_time_out',
    ];

    // Accessor for the dynamic attribute
    public function getDaysLeftAttribute()
    {
        // Calculate the difference in days
        $eventDate = Carbon::parse($this->attributes['event_date']);
        $currentDate = Carbon::now();
        
        // If the event date is in the past, return 0
        if ($currentDate->gt($eventDate)) {
            return 0;
        }
    
        $daysLeft = $eventDate->diffInDays($currentDate);
        return $daysLeft;
    }
}
