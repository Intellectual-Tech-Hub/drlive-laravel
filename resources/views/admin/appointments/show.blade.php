@extends('admin.layouts.master')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointments Details</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@php
    $day = Carbon\carbon::parse($appointment->date)->format('D');
@endphp
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Patient Information</h4>
                <p class="card-title-desc"></p>
                <table class="table mb-0">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $appointment->patient->first_name.' '.$appointment->patient->last_name }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ $appointment->patient->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $appointment->patient->phone }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>
                            {{ Carbon\carbon::parse($appointment->patient->dob)->diff(Carbon\carbon::now())->format('%y years') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $appointment->patient->gender }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Appointment Information</h4>
                <p class="card-title-desc"></p>
                <table class="table mb-0">
                    <tbody>
                    <tr>
                        <th>Doctor Name</th>
                        <td>
                            DR. {{ $appointment->doctor->doctordetails->first_name.' '.$appointment->doctor->doctordetails->last_name }}
                            ({{ $appointment->doctor->designation }})
                        </td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>
                            {{ Carbon\carbon::parse($appointment->date)->format('d-m-Y') }}
                            <span class="badge bg-primary">{{ $day }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Token No</th>
                        <td>{{ $appointment->token_no }}</td>
                    </tr>
                    <tr>
                        <th>Expected Time</th>
                        <td>
                            {{ App\Models\Appointment::expectedtime($appointment->doctor_id, $day, $appointment->date) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Already Treated</th>
                        <td>
                            @if ($appointment->status == 'new')
                                <span class="badge bg-danger">No</span>
                            @elseif ($appointment->status == 'completed')
                                <span class="badge bg-success">Yes</span>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('script')
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script> 
@endpush