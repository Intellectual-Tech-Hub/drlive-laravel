<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    use HasFactory;

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public static function timeslot($id)
    {
        $slot = TimeSlot::where('id',$id)->first();
        return Carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon::parse($slot->end_time)->format('h:i A');

    }

}
