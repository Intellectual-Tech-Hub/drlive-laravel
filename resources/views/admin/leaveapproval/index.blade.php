@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Leave Approval</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave Approval</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer"
                                        role="grid" aria-describedby="datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th>S.I</th>
                                                <th>Name</th>
                                                <th>Leave Type</th>
                                                <th>From Date</th>
                                                <th>TO Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($users as $items)
                                                <tr>

                                                    <td class="sorting_1">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $items->user->first_name.' '.$items->user->last_name }}</td>
                                                    <td>{{ $items->type->Leavetype }}</td>
                                                    <td>{{ $items->Fromdate }}</td>
                                                    <td>{{ $items->Todate }}</td>

                                                    <td>



                                                        <a href="{{ route('leaveapprove.show', $items->id) }}"
                                                            class="btn btn-warning btn-sm float-left mr-1"
                                                            style="height:30px; width:30px;border-radius:50%"
                                                            data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                                class="fas fa-eye"></i>
                                                        </a>

                                                        <form method="POST"
                                                            action="{{ route('leaveapprove.destroy', $items->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm warning"
                                                                data-id={{ $items->id }}
                                                                style="height:30px; width:30px;border-radius:50%"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Delete"><i class="fas fa-trash-alt"></i>
                                                            </button>

                                                        </form>

                                                    </td>
                                                </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                        Showing 1 to 1 of 1 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                                <a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0"
                                                    class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="datatable" data-dt-idx="1" tabindex="0"
                                                    class="page-link">1</a></li>
                                            <li class="paginate_button page-item next disabled" id="datatable_next"><a
                                                    href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0"
                                                    class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
@endsection
