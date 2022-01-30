<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorAvailability;
use App\Models\TimeSlot;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DoctorAvailabilityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:doctor_availability_list');
        $this->middleware('permission:doctor_availability_create', ['only' => ['create','store']]);
        $this->middleware('permission:doctor_availability_update', ['only' => ['edit','update']]);
        $this->middleware('permission:doctor_availability_show', ['only' => ['show']]);
        $this->middleware('permission:doctor_availability_delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availables = DoctorAvailability::get();
        return view('admin.doctor_availability.availability.index', compact('availables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::all();
        $timeslots = TimeSlot::all();
        return view('admin.doctor_availability.availability.create', compact('doctors','timeslots'));
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
            'doctor_id' => 'required'
        ]);

        $mon = implode(',',$request->slot1);
        $tue = implode(',',$request->slot2);
        $wed = implode(',',$request->slot3);
        $thu = implode(',',$request->slot4);
        $fri = implode(',',$request->slot5);
        $sat = implode(',',$request->slot6);
        $sun = implode(',',$request->slot7);
        
        $availability = new DoctorAvailability();
        $availability->doctor_id = $request->doctor_id;
        $availability->mon = $mon;
        $availability->tue = $tue;
        $availability->wed = $wed;
        $availability->thu = $thu;
        $availability->fri = $fri;
        $availability->sat = $sat;
        $availability->sun = $sun;
        $status = $availability->save();

        if ($status) {
            Toastr::success('Doctor availability added','Success');
            return redirect()->route('availability.index');
        }
        else {
            Toastr::erroe('Doctor availability failed to add','Failed');
            return redirect()->route('availability.index');
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
}
