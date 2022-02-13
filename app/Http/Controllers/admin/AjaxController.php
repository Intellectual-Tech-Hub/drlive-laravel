<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Medicine;
use App\Models\MedicineType;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function getdoctors(Request $request)
    {
        $doctors = DoctorCategory::join('doctors','doctors.id','=','doctor_categories.doctor_id')
                ->join('users','doctors.user_id','=','users.id')
                ->where('doctor_categories.category_id',$request->id)->select('doctors.id','users.first_name','users.last_name')
                ->get();
        return response()->json($doctors);
    }

    public function medicinetypes()
    {
        $types = MedicineType::get();
        return response()->json($types);
    }

    public function medicines()
    {
        $medicines = Medicine::where('status',1)->get();
        return response()->json($medicines);
    }

}
