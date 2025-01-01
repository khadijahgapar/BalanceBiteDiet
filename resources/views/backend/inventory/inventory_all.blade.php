@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Inventories</h4>

                        
                </div>
            </div>
        </div>
            <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('inventory.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Inventory</a><br>

                        <h4 class="card-title">All Inventories Data </h4><br>
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                <label>Show 
                                <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                        <option value="10" {{ $inventories->perPage() == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ $inventories->perPage() == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ $inventories->perPage() == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ $inventories->perPage() == 100 ? 'selected' : '' }}>100</option>
                                    </select> entries
                                </label>
                                </div>
                            </div>
                            <!-- Add this section above your table -->
                            <div class="col-sm-12 col-md-6">
                                <div id="datatable_filter" class="dataTables_filter">
                                    <form method="GET" action="{{ route('inventory.all') }}">
                                        <label>Search:
                                            <input type="search" class="form-control form-control-sm" name="search" value="{{ $search }}" placeholder="" aria-controls="datatable">
                                        </label>
                                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    </form>
                                </div>
                            </div>
                        <!-- End of search input -->
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">


                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Inventory Code</th>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>User (Employee)</th>
                                <th>Action</th>
                                
                            </thead>


                            <tbody>
                                
                                @foreach($inventories as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $item->code }} </td>
                                <td> {{ $item->brandName }} </td>
                                <td> {{ $item['category']['name'] }} </td>
                                <td>
                                    @if($item->status == 'AVAILABLE')
                                        <div class="spinner-grow text-success m-1" style="width: 0.7rem; height: 0.7rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    @elseif($item->status == 'IN USE')
                                        <div class="spinner-grow text-warning m-1" style="width: 0.7rem; height: 0.7rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    @elseif($item->status == 'UNFUNCTIONAL')
                                        <div class="spinner-grow text-danger m-1" style="width: 0.7rem; height: 0.7rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    @endif
                                    <b>{{ $item->status }}</b>
                                </td>
                                <td> {{ optional($item->user)->username ?: 'NONE' }} </td>
                                
                                <td>
                                    <a href="{{route('inventory.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

                                    <a href="{{route('inventory.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                                </td>
                            
                            </tr>
                            @endforeach
                            
                            </tbody>
                        </table>


                        <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                Showing {{ $inventories->firstItem() }} to {{ $inventories->lastItem() }} of {{ $inventories->total() }} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    @if ($inventories->onFirstPage())
                                        <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item previous" id="datatable_previous">
                                            <a href="{{ $inventories->previousPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($inventories->getUrlRange(1, $inventories->lastPage()) as $page => $url)
                                        @if ($page == $inventories->currentPage())
                                            <li class="paginate_button page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item">
                                                <a href="{{ $url }}" aria-controls="datatable" class="page-link" tabindex="0">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($inventories->hasMorePages())
                                        <li class="paginate_button page-item next" id="datatable_next">
                                            <a href="{{ $inventories->nextPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
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