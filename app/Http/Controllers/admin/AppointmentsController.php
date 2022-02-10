<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\DoctorAvailability;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appoitments = Appointment::get();
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
            'doctor_id' => 'required|integer',
            'status' => 'required'
        ]);

        $date = Carbon::parse($request->date)->format('D');
        /* $exist = Appointment::join('doctor_availabilities','doctor_availabilities.doctor_id','=','appointments.doctor_id')
                ->where('appointments.date',$request->date)->where('appointments.category_id',$request->category_id)
                ->where('appointments.doctor_id',$request->doctor_id)->orderBy('appointments.token_no','DESC')
                ->where('doctor_availabilities.day',$date)->first(); */

        $exist = Appointment::where('date',$request->date)->where('category_id',$request->category_id)
            ->where('doctor_id',$request->doctor_id)->orderBy('token_no','DESC')->first();

        $available = DoctorAvailability::where('day',$date)->where('status',1)->first();
        
        if (!$exist) {
            $token = 1;
        }
        else {
            if ($exist->token_no == $exist->sit_quantity) {
                Toastr::error('Appointments are full for the selected date', 'Failed');
                return redirect()->route('appointment.create');
            }
            else {
                $token = $exist->token_no + 1;
            }
        }

        $appointment = new Appointment();
        $appointment->user_id = $request->patient;
        $appointment->category_id = $request->category_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->date;
        $appointment->payment_status = 'unpaid';
        $appointment->status = $request->status;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function history()
    {
        $appoitments = Appointment::get();
        return view('admin.appointments.history', compact('appoitments'));
    }

}
