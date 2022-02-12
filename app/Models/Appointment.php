<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public static function expectedtime($doctor_id, $day, $date)
    {
        $appointment = Appointment::where('doctor_id',$doctor_id)->where('date',$date)->first();
        $available = DoctorAvailability::where('doctor_id',$doctor_id)->where('day',$day)->where('status',1)->first();
        $start_time = Carbon::createFromFormat('H:i', $available->start_time);
        $end_time = Carbon::createFromFormat('H:i', $available->end_time);
        $timediff = $end_time->diffInMinutes($start_time);
        $per_person = $timediff / $available->sit_quantity;
        $time = $per_person * ($appointment->token_no - 1);
        return $start_time->addMinutes($time)->format('h:i A');
    }

}
