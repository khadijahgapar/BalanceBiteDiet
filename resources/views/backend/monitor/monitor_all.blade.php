@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All Inventory Monitor</h4>
                                     

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Inventory Monitor Data </h4><br>
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row"><div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="datatable_length">
                            <label>Show 
                                <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="10" {{ $monitors->perPage() == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ $monitors->perPage() == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ $monitors->perPage() == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $monitors->perPage() == 100 ? 'selected' : '' }}>100</option>
                                </select> entries
                            </label>
                            </div>
                        </div>
                        <!-- Add this section above your table -->
                        <div class="col-sm-12 col-md-6">
                            <div id="datatable_filter" class="dataTables_filter">
                                <form method="GET" action="{{ route('monitor.all') }}">
                                    <label>Search:
                                        <input type="search" class="form-control form-control-sm" name="search" value="{{ $search }}" placeholder="" aria-controls="datatable">
                                    </label>
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </form>
                            </div>
                        </div>
                    <!-- End of search input -->
                    </div>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Inventory Code</th>
                            <th>Brand Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>User (Employee)</th>
                            <!--<th>Action</th> -->
                            
                        </thead>


                        <tbody>
                        	 
                        	@foreach($monitors as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->monCode }} </td>
                            <td> {{ $item->monName }} </td>
                            <td> {{ $item['category']['name'] }}</td>
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
                            
                            <!--<td>
   <a href="{{route('monitor.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{route('monitor.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>-->
                           
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                Showing {{ $monitors->firstItem() }} to {{ $monitors->lastItem() }} of {{ $monitors->total() }} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    @if ($monitors->onFirstPage())
                                        <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item previous" id="datatable_previous">
                                            <a href="{{ $monitors->previousPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($monitors->getUrlRange(1, $monitors->lastPage()) as $page => $url)
                                        @if ($page == $monitors->currentPage())
                                            <li class="paginate_button page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item">
                                                <a href="{{ $url }}" aria-controls="datatable" class="page-link" tabindex="0">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($monitors->hasMorePages())
                                        <li class="paginate_button page-item next" id="datatable_next">
                                            <a href="{{ $monitors->nextPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
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