<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorFee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DoctorFeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:doctor_fees_list');
        $this->middleware('permission:doctor_fees_create', ['only' => ['create','store']]);
        $this->middleware('permission:doctor_fees_update', ['only' => ['edit','update']]);
        $this->middleware('permission:doctor_fees_delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = DoctorFee::get();
        return view('admin.doctor_fees.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::get();
        return view('admin.doctor_fees.create', compact('doctors'));
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
            'doctor' => 'required|unique:doctor_fees,doctor_id',
            'fees' => 'required',
        ]);

        $fee = new DoctorFee();
        $fee->doctor_id = $request->doctor;
        $fee->fees = $request->fees;
        $status = $fee->save();

        if ($status) {
            Toastr::success('Doctor fee added', 'Success');
            return redirect()->route('fees.index');
        }
        else {
            Toastr::error('Doctor fee failed to add', 'Failed');
            return redirect()->route('fees.index');
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
        $this->validate($request, [
            'fees' => 'required',
        ]);

        $fee = DoctorFee::findOrfail($id);
        $fee->fees = $request->fees;
        $status = $fee->save();

        if ($status) {
            Toastr::success('Doctor fee updated', 'Success');
            return redirect()->route('fees.index');
        }
        else {
            Toastr::error('Doctor fee failed to update', 'Failed');
            return redirect()->route('fees.index');
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
        $fee = DoctorFee::findOrfail($id);
        $status = $fee->delete();

        if ($status) {
            Toastr::success('Doctor fee deleted', 'Success');
            return redirect()->route('fees.index');
        }
        else {
            Toastr::error('Doctor fee failed to delete', 'Failed');
            return redirect()->route('fees.index');
        }
    }
}
