@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Inventory Report</h4>

                        
                </div>
            </div>
        </div>
            <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('inventory.report.pdf')}}" target="_blank" class="btn btn-warning waves-effect waves-light" style="float:right;">
                            <i class="fa fa-print"></i> Report Print</a><br>



                        <h4 class="card-title">Inventory Report</h4><br>
                        
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Inventory Code</th>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>User (Employee)</th> 
                                
                            </thead>


                            <tbody>
                                
                                @foreach($allData as $key => $item)
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
                                
                            
                            </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                Showing {{ $allData->firstItem() }} to {{ $allData->lastItem() }} of {{ $allData->total() }} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    @if ($allData->onFirstPage())
                                        <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item previous" id="datatable_previous">
                                            <a href="{{ $allData->previousPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($allData->getUrlRange(1, $allData->lastPage()) as $page => $url)
                                        @if ($page == $allData->currentPage())
                                            <li class="paginate_button page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item">
                                                <a href="{{ $url }}" aria-controls="datatable" class="page-link" tabindex="0">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($allData->hasMorePages())
                                        <li class="paginate_button page-item next" id="datatable_next">
                                            <a href="{{ $allData->nextPageUrl() }}" aria-controls="datatable" class="page-link" tabindex="0">
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