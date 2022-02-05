@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Pending Leave</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Leave</li>
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
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="datatable_length"><label>Show <select
                                                name="datatable_length" aria-controls="datatable"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                class="form-control form-control-sm" placeholder=""
                                                aria-controls="datatable"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer"
                                        role="grid" aria-describedby="datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="S.I: activate to sort column descending"
                                                    style="width: 38.25px;">S.I</th><th class="sorting_asc" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="S.I: activate to sort column descending"
                                                    style="width: 38.25px;">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 129.663px;">Leave Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Last Name: activate to sort column ascending"
                                                    style="width: 128.075px;">From Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Email: activate to sort column ascending"
                                                    style="width: 194.4px;">TO Date</th>
                                                
                                               
                                                <th class="sorting" tabindex="0" aria-controls="datatable"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 83.5625px;">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @php
                                 $users = DB::table('leavedefines')->select('id','Leavetype','Fromdate','Todate','Reason','status')->get();
                                             @endphp

                                                @foreach ($users as $items)
                                                @if ($items->status==2)
                                                <tr class="">

                                                    <td class="sorting_1">{{ $items->id }}</td>
                                                    <td>{{ Auth::user()->id }}</td>
                                                    <td>{{ $items->Leavetype }}</td>
                                                    <td>{{ $items->Fromdate }}</td>
                                                    <td>{{ $items->Todate }}</td>
                                                    
                                                    <td>
                                                      
                                                           <a href="{{ route('leaveapprove.edit',$items->id) }}"
                                                            class="btn btn-primary btn-sm float-left mr-1"
                                                            style="height:30px; width:30px;border-radius:50%"
                                                            data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                                class="fas fa-edit"></i></a>
                                                       
                                                        
                                                        <form method="POST" action="{{ route('leaveapprove.destroy',$items->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                             <button
                                                                class="btn btn-danger btn-sm warning" data-id={{$items->id}} 
                                                                style="height:30px; width:30px;border-radius:50%"
                                                                data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                                                    class="fas fa-trash-alt"></i>
                                                              </button>
                                                    
                                                        </form>
                                                        <a href="{{ route('leaveapprove.show',$items->id) }}"
                                                            class="btn btn-warning btn-sm float-left mr-1"
                                                            style="height:30px; width:30px;border-radius:50%"
                                                            data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                                class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                          

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
                                                    class="page-link">Previous</a></li>
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