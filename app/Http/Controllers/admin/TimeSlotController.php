<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:time_slot_list');
        $this->middleware('permission:time_slot_create', ['only' => ['create','store']]);
        $this->middleware('permission:time_slot_update', ['only' => ['edit','update']]);
        $this->middleware('permission:time_slot_delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = TimeSlot::get();
        return view('admin.doctor_availability.time_slots.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor_availability.time_slots.create');
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
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required'
        ]);

        $time= new TimeSlot();
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->status = $request->status;
        $status = $time->save();

        if ($status) {
            Toastr::success('Time slot added','Success');
            return redirect()->route('timeslots.index');
        }
        else {
            Toastr::error('Time slot failed to add','Failed');
            return redirect()->route('timeslots.index');
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
        $time = TimeSlot::findOrFail($id);
        return view('admin.doctor_availability.time_slots.edit', compact('time'));
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
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required'
        ]);

        $time= TimeSlot::findOrFail($id);
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->status = $request->status;
        $status = $time->save();

        if ($status) {
            Toastr::success('Time slot updated','Success');
            return redirect()->route('timeslots.index');
        }
        else {
            Toastr::error('Time slot failed to update','Failed');
            return redirect()->route('timeslots.index');
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
        $time= TimeSlot::findOrFail($id);
        $status = $time->delete();

        if ($status) {
            Toastr::success('Time slot deleted','Success');
            return redirect()->route('timeslots.index');
        }
        else {
            Toastr::error('Time slot failed to delete','Failed');
            return redirect()->route('timeslots.index');
        }
    }
}
