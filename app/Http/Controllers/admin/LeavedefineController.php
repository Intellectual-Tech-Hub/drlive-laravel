<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Leavedefine;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LeavedefineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leavedefine::get();
        //return $leaves;
        return view('admin.leavedefine.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leavetable['leave'] = Leave::all();
        return view('admin.leavedefine.create',$leavetable);   
        
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
            'leavetype' => 'required|integer',
            'fromdate' => 'required|date',
            'todate' => 'required|date|after_or_equal:fromdate',
            'reason' => 'required'
        ]);

       $Leavetype = $request->leavetype;
       $Fromdate = $request->fromdate;
       $Todate = $request->todate;
       $Reason = $request->reason;

       $leavedefine = new Leavedefine();
       $leavedefine->user_id = Auth::user()->id;
       $leavedefine->Leavetype = $Leavetype;
       $leavedefine->Fromdate = $Fromdate;
       $leavedefine->Todate = $Todate;
       $leavedefine->Reason =$Reason;
       $status = $leavedefine->save();

       if ($status) {
           Toastr::success('Leave applied','Success');
           return redirect()->route('leavedefine.index');
       }
       else {
            Toastr::error('Leave failed to apply','Failed');
            return redirect()->route('leavedefine.index');
       }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
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
        return view('admin.leavedefine.edit',$leavedefine);
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
            'leavetype' => 'required|integer',
            'fromdate' => 'required|date',
            'todate' => 'required|date|after_or_equal:fromdate',
            'reason' => 'required'
        ]);
        
        $leavedefine = Leavedefine::find($id);
        // return $leavedefine;

        $leavedefine->Leavetype = $request->leavetype;
        $leavedefine->Fromdate = $request->fromdate;
        $leavedefine->Todate = $request->todate;
        $leavedefine->Reason =$request->reason;
        $status = $leavedefine->update();

        if ($status) {
            Toastr::success('Leaveapplication updated','success');
             return redirect()->route('leavedefine.index');
        }
        else {
            Toastr::error('Leaveapplication updation failed','failed');
            return redirect()->route('leavedefine.index');
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
            Toastr::success('Leave Application deleted','Success');
            return redirect()->route('leavedefine.index');
        }
        else {
            Toastr::error('Leave Application failed to delete','Failed');
            return redirect()->route('leavedefine.index');
        }
    }
}
