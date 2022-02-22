<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\DoctorAvailability;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function appointmentsubmit(Request $request)
    {
        $category_id = $request->category_id;
        $doctor_id = $request->doctor_id;
        $date  = $request->date;
        $method  = $request->method;
        $patient_id = $request->patient_id;

        if ($category_id==NULL || $doctor_id==NULL || $patient_id==NULL || $date==NULL ||$method==NULL) {
            return response()->json([
                'result' => false,
                'message' => 'please input all necessary fields',
            ],404);
        }
        $day = Carbon::parse($date)->format('D');

        $exist = Appointment::where('date',$date)->where('category_id',$category_id)
            ->where('doctor_id',$doctor_id)->orderBy('token_no','DESC')->first();

        $available = DoctorAvailability::where('doctor_id',$doctor_id)->where('day',$day)
            ->where('status',1)->first();

        if (!$available) {
            return response()->json([
                'result' => false,
                'message' => 'doctor is not aavailable for this day',
            ],404);
        }
        else {
            if (!$exist) {
                $token = 1;
            }
            else {
                if ($exist->token_no == $available->sit_quantity) {
                    return response()->json([
                        'result' => false,
                        'message' => 'appointments are full for the selected date',
                    ],404);
                }
                else {
                    $token = $exist->token_no + 1;
                }
            }
        }

        $appointment = new Appointment();
        $appointment->user_id = $patient_id;
        $appointment->category_id = $category_id;
        $appointment->doctor_id = $doctor_id;
        $appointment->date = $date;
        $appointment->method = $method;
        $appointment->payment_status = 'unpaid';
        $appointment->status = 'new';
        $appointment->token_no = $token;
        $status = $appointment->save();

        $last = Appointment::orderBy('created_at','DESC')->first();
        $patient = User::where('id',$last->user_id)->first();
        $doctor = Doctor::with('doctordetails')->where('id',$last->doctor_id)->first();
        $category = Category::where('id',$last->category_id)->first();

        if ($status) {
            return response()->json([
                'result' => true,
                'message' => 'appointtment success',
                'appointment' => $last,
                'caategory' => $category,
                'doctor' => $doctor,
                'patient' => $patient
            ],200);
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'aappointment failed',
            ],404);
        }
    }
}
