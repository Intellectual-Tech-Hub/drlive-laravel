<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\DoctorAvailability;
use App\Models\Medicine;
use App\Models\MedicineType;
use App\Models\Prescription;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $appoitments = Appointment::where('date','>=',$today)->get();
        return view('admin.appointments.index', compact('appoitments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = User::whereHas("roles", function($q) { $q->where("name", "patient"); })->get();
        $categories = Category::get();
        return view('admin.appointments.create', compact('patients','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient' => 'required|integer',
            'date' => 'required|date',
            'category_id' => 'required|integer',
            'doctor_id' => 'required|integer'
        ]);

        $day = Carbon::parse($request->date)->format('D');

        $exist = Appointment::where('date',$request->date)->where('category_id',$request->category_id)
            ->where('doctor_id',$request->doctor_id)->orderBy('token_no','DESC')->first();

        $available = DoctorAvailability::where('doctor_id',$request->doctor_id)->where('day',$day)
            ->where('status',1)->first();

        if (!$available) {
            Toastr::error('Doctor is not available for this day', 'Failed');
            return redirect()->route('appointment.create');
        }
        else {
            if (!$exist) {
                $token = 1;
            }
            else {
                if ($exist->token_no == $available->sit_quantity) {
                    Toastr::error('Appointments are full for the selected date', 'Failed');
                    return redirect()->route('appointment.create');
                }
                else {
                    $token = $exist->token_no + 1;
                }
            }
        }

        $appointment = new Appointment();
        $appointment->user_id = $request->patient;
        $appointment->category_id = $request->category_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->date;
        $appointment->payment_status = 'unpaid';
        $appointment->status = 'new';
        $appointment->token_no = $token;
        $status = $appointment->save();

        if ($status) {
            Toastr::success('Appointment added', 'Success');
            return redirect()->route('appointment.index');
        }
        else {
            Toastr::error('Appointment failed to add', 'Failed');
            return redirect()->route('appointment.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrfail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $medicine_types = MedicineType::get();
        $medicines = Medicine::where('status',1)->get();
        return view('admin.appointments.edit', compact('appointment','medicine_types','medicines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'weight' => 'required|numeric',
            'blood_pressure' => 'required|numeric',
            'pulse' => 'required|numeric',
            'temperature' => 'required|numeric',
            'medicine_type' => 'required|array',
            'medicine' => 'required|array',
            'dosage' => 'required|array',
            'days' => 'required|array',
            'time' => 'required|array'
        ]);

        try {
            DB::beginTransaction();
            $appointment = Appointment::findOrFail($id);
            $appointment->weight = $request->weight;
            $appointment->blood_pressure = $request->blood_pressure;
            $appointment->pulse = $request->pulse;
            $appointment->temperature = $request->temperature;
            $appointment->problem = $request->problem_description;
            $appointment->payment_status = 'paid';
            $appointment->status = 'completed';
            $status = $appointment->save();

            for ($i=0; $i<count($request->medicine); $i++) {
                $prescription = new Prescription();
                $prescription->appointment_id = $id;
                $prescription->medicine_type_id = $request->medicine_type[$i];
                $prescription->medicine_id = $request->medicine[$i];
                $prescription->dosage = $request->dosage[$i];
                $prescription->days = $request->days[$i];
                $prescription->time = $request->time[$i];
                $prescription->save();
            }
            DB::commit();
            Toastr::success('Prescription added', 'Success');
            return redirect()->route('appointments.today');
        }
        catch (Exception $e) {
            DB::rollBack();
            Toastr::error('Prescription failed to add', 'Failed');
            return redirect()->route('appointments.today');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrfail($id);
        $status = $appointment->delete();

        if ($status) {
            Toastr::success('Appointment deleted', 'Success');
            return redirect()->route('appointment.index');
        }
        else {
            Toastr::error('Appointment failed to delete', 'Failed');
            return redirect()->route('appointment.index');
        }
    }

    public function history()
    {
        $appoitments = Appointment::get();
        return view('admin.appointments.history', compact('appoitments'));
    }

    public function today()
    {
        $today = Carbon::now()->format('Y-m-d');
        $appoitments = Appointment::where('date',$today)->get();
        return view('admin.appointments.today', compact('appoitments'));
    }

}
