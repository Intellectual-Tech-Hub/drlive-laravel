@extends('admin.layouts.master')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add Doctor Availability</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Doctor Availability</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Add Doctor Availability</h4>

                <form method="POST" action="{{ route('availability.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Select Doctor</label>
                                <select name="doctor_id" value="{{ old('doctor_id') }}" class="form-control select2">
                                    <option value="">select doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->doctordetails->first_name. ' ' . $doctor->doctordetails->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Monday</label>
                        <div class="col-sm-5">
                            <select name="slot1[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Tuesday</label>
                        <div class="col-sm-5">
                            <select name="slot2[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Wednesday</label>
                        <div class="col-sm-5">
                            <select name="slot3[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Thursday</label>
                        <div class="col-sm-5">
                            <select name="slot4[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Friday</label>
                        <div class="col-sm-5">
                            <select name="slot5[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Saturday</label>
                        <div class="col-sm-5">
                            <select name="slot6[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sunday</label>
                        <div class="col-sm-5">
                            <select name="slot7[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose time slots...">
                                <option value="">select doctor</option>
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}">{{ Carbon\carbon::parse($slot->start_time)->format('h:i A') . ' to ' . Carbon\carbon::parse($slot->end_time)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->

@endsection