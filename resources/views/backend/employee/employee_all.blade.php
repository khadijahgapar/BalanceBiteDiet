@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All Employee</h4>

                                     

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <!--<a href="{{route('employee.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Category</a><br>-->

                                    <h4 class="card-title">All Employees Data </h4><br>
                                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row"><div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="datatable_length">
                                            <label>Show 
                                                <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="10" {{ $employees->perPage() == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ $employees->perPage() == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ $employees->perPage() == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ $employees->perPage() == 100 ? 'selected' : '' }}>100</option>
                                                </select> entries
                                            </label>
                                            </div>
                                        </div>
                                        <!-- Add this section above your table -->
                                        <div class="col-sm-12 col-md-6">
                                            <div id="datatable_filter" class="dataTables_filter">
                                                <form method="GET" action="{{ route('employee.all') }}">
                                                    <label>Search:
                                                        <input type="search" class="form-control form-control-sm" name="search" value="{{ $search }}" placeholder="" aria-controls="datatable">
                                                    </label>
                                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                                </form>
                                            </div>
                                        </div>
                                    <!-- End of search input -->
                                </div>
                                        <div class="row"><div class="col-sm-12">
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                                

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                            
                        </thead>


                        <tbody>
                        	 
                        	@foreach($employees as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->designation }} </td>
                            <td> {{ $item->email }} </td>
                            <td> {{ $item->phone_no }} </td>
                            
                            <td>
    <!--<a href="{{route('employee.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>-->

    <a href="{{route('employee.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>
                           
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    @if ($employees->onFirstPage())
                                        <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item previous" id="datatable_previous">
                                            <a href="{{ $employees->previousPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                                        @if ($page == $employees->currentPage())
                                            <li class="paginate_button page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item">
                                                <a href="{{ $url }}" aria-controls="datatable" class="page-link" tabindex="0">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($employees->hasMorePages())
                                        <li class="paginate_button page-item next" id="datatable_next">
                                            <a href="{{ $employees->nextPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item next disabled" id="datatable_next">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    </div>
                        
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
              
    </div> <!-- container-fluid -->
</div>
 
@endsection