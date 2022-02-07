@extends('admin.layouts.master')
@section('content')

    <div class="container-fluid">


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Leave Approve Edit Form</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave Approve Edit Form</li>
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
                        <h4 class="card-title mb-4">Edit Defined details</h4>

                        <form method="POST" action="{{ route('leavedefine.update',$edit->id) }}">   
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Leave Type</label>
                              
                                        <select id="cars" class="form-control" name="leavetype">
                                            @foreach ( $users as $items )
                                            <option value="{{ $items->id }}">{{ $items->Leavetype }}</option>
                                                
                                            @endforeach
                                            
                                         </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">From Date</label>
                                        <input type="date" name="fromdate" value="{{ $edit->Fromdate }}" class="form-control"
                                            id="formrow-email-input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">To Date</label>
                                        <input type="date" name="todate" value="{{ $edit->Todate }}" class="form-control"
                                            id="formrow-email-input">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Reason For The Leave</label>
                                        <textarea type="text" name="reason" value="{{ $edit->Reason }}" class="form-control"
                                            id="formrow-email-input">{{ $edit->Reason }}</textarea>
                                    </div>
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


    </div>
@endsection

