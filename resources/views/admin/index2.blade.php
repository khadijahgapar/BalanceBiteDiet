@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">BalanceBite</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
            

        <div class="row">

            <div class="col-xl-6 col-md-12">
                    
                    <video class="rounded me-2" width="90%" height="auto" controls autoplay style="border: 5px solid white;">
                    <source src="{{ asset('backend/assets/images/vdp.mp4') }}" type="video/mp4" class="rounded me-2">
                    </video>
                    
            </div><!-- end col -->
            


                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Inventories</p>
                                    <h4 class="mb-2">{{ $quantity }}</h4>
                                    <p class="text-muted mb-0">
                                    <span class="text-success fw-bold font-size-12 me-2">
                                    @if ($inUsePercentage > 0)
                                        <i class="ri-arrow-right-up-line me-1 align-middle"></i>
                                    @elseif ($inUsePercentage < 0)
                                        <i class="ri-arrow-right-down-line me-1 align-middle"></i>
                                    @else
                                        <i class="ri-arrow-right-line me-1 align-middle"></i>
                                    @endif
                                    {{ number_format($inUsePercentage, 2) }}%</span>is being used
                                    </p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="dripicons-box font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Users</p>
                                    <h4 class="mb-2">{{ $totalUsers }}</h4>
                                    <p class="text-muted mb-0">
                                        <span class="text-success fw-bold font-size-12 me-2">
                                        @if ($countDifferencePercentage > 0)
                                            <i class="ri-arrow-right-up-line me-1 align-middle"></i>
                                        @elseif ($countDifferencePercentage < 0)
                                            <i class="ri-arrow-right-down-line me-1 align-middle"></i>
                                        @else
                                            <i class="ri-arrow-right-line me-1 align-middle"></i>
                                        @endif
                                        {{ number_format($countDifferencePercentage, 2) }}%</span>by previous period
                                    </p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

                
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Categories Hardware</h4>

                            <div class="row">
                                <p class="card-title-desc">The 
                                    <code class="highlighter-rounge">AVAILABLE
                                    </code> Hardware in Inventories.
                                </p>

                                <div class="col-md-6">
                                
                                    <div class="d-flex justify-content-between mb-3">
                                        <p class="text-muted">Keyboards</p>
                                        <p class="text-muted">{{$keyboardPercentage}}%  
                                            <span class="text-success fw-bold font-size-12 me-2">from {{$availableK}}/{{$totalKeyboard}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$keyboardPercentage}}%" aria-valuenow="{{$keyboardPercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between mb-3">
                                        <p class="text-muted">Mouse</p>
                                        <p class="text-muted">{{$mousePercentage}}%
                                            <span class="text-success fw-bold font-size-12 me-2">from {{$availableMou}}/{{$totalMouse}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$mousePercentage}}%" aria-valuenow="{{$mousePercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between mb-3">
                                        <p class="text-muted">Monitor</p>
                                        <p class="text-muted">{{$monitorPercentage}}%
                                            <span class="text-success fw-bold font-size-12 me-2">from {{$availableMo}}/{{$totalMonitor}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$monitorPercentage}}%" aria-valuenow="{{$monitorPercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between mb-3">
                                        <p class="text-muted">Personal Computer (PC)</p>
                                        <p class="text-muted">{{$pcPercentage}}%
                                            <span class="text-success fw-bold font-size-12 me-2">from {{$availablePc}}/{{$totalPc}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{$pcPercentage}}%" aria-valuenow="{{$pcPercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row --> 




        

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <!--<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>-->
                            
                        </div>

                        <h4 class="card-title mb-4">Latest Inventories</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Brand Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead><!-- end thead -->

                                <tbody>
                                
                                @forelse($dashboard as $key => $item)
                                    <tr>
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
                                        <td> {{ $item->created_at }} </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No data available</td>
                                        </tr>
                                    @endforelse
                                
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div><!-- end row -->    
        

    </div><!-- container fuild -->
                    
</div>

@endsection
