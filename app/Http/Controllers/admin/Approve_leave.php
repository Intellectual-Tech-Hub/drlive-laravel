<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Leavedefine;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class Approve_leave extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.leaveapproval.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
public function status(Request $request,$id)
    {
        // return $id;
        $data = Leavedefine::find($id);
        if ($data->status == NULL) {
            $data->status = 1;
            $status = $data->save();
            if ($status) {
                Toastr::success('Leave approved','Success');
                return redirect()->route('leaveapprove.index');
            }
            else {
                Toastr::error('Leave failed to approve','Failed');
                return redirect()->route('leaveapprove.index');
            }
        } else {
            Toastr::error('Leave already approved','Failed');
            return redirect()->route('leaveapprove.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $leavedefine['define'] = Leavedefine::find($id);
        return view('admin.leaveapproval.show',$leavedefine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leavedefine['edit'] = Leavedefine::find($id);
        return view('admin.leaveapproval.edit',$leavedefine);
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
        $leavedefine = Leavedefine::find($id);
        // return $leavedefine;

        $leavedefine->Leavetype = $request->leavetype;
        $leavedefine->Fromdate = $request->fromdate;
        $leavedefine->Todate = $request->todate;
        $leavedefine->Reason =$request->reason;
        $leavedefine->update();
        $status = $leavedefine->update();
        if ($status) {
           Toastr::success('deleted','Success');
           return redirect()->route('leaveapprove.index');
       }
       else {
           Toastr::error('updated','Failed');
           return redirect()->route('leaveapprove.index');
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
        $delete = Leavedefine::find($id);

        $status = $delete->delete();
         if ($status) {
            Toastr::success('deleted','Success');
            return redirect()->route('leaveapprove.index');
        }
        else {
            Toastr::error('updated','Failed');
            return redirect()->route('leaveapprove.index');
        }
    }
}
