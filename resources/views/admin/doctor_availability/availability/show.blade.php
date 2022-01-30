@extends('admin.layouts.master')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Show Doctor Availability</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Show Doctor Availability</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@php
    $mon = explode(',',$available->mon);
    $tue = explode(',',$available->tue);
    $wed = explode(',',$available->wed);
    $thu = explode(',',$available->thu);
    $fri = explode(',',$available->fri);
    $sat = explode(',',$available->sat);
    $sun = explode(',',$available->sun);
@endphp
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Show Doctor Availability</h4>

                    <div class="row mb-3">
                        <label for="formrow-email-input" class="col-sm-3 col-form-label"><b>Doctor Name : </b></label>
                        <div class="col-sm-5">
                            <label for="formrow-email-input" class="col-sm-9 col-form-label"><b>DR. {{ $available->doctor->doctordetails->first_name. ' ' . $available->doctor->doctordetails->last_name }}</b></label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">
                   
                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Monday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($mon as $m)
                                    {{ App\Models\DoctorAvailability::timeslot($m) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Tuesday  : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($tue as $t)
                                    {{ App\Models\DoctorAvailability::timeslot($t) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Wednesday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($wed as $w)
                                    {{ App\Models\DoctorAvailability::timeslot($w) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Thursday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($thu as $h)
                                    {{ App\Models\DoctorAvailability::timeslot($h) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Friday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($fri as $f)
                                    {{ App\Models\DoctorAvailability::timeslot($f) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Saturday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($sat as $s)
                                    {{ App\Models\DoctorAvailability::timeslot($s) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <hr style="height: 5px; color : black">

                    <div class="row mb-5"> 
                        <label for="formrow-email-input" class="col-sm-3 col-form-label">Sunday : </label>
                        <div class="col-sm-9">
                            <label for="formrow-email-input" class="col-sm-3 col-form-label">
                                @foreach ($sun as $su)
                                    {{ App\Models\DoctorAvailability::timeslot($su) }}<br>
                                @endforeach
                            </label>
                        </div>
                    </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->

@endsection