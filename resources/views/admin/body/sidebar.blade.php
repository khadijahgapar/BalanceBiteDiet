<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @php
        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
        @endphp


        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}"
                        alt="Header Avatar" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{$adminData->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="mm-active">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mm-show" id="side-menu">
                <li class="menu-title">Menu</li>

                <!--<li>
                    <a href="" class="waves-effect">
                        <i class="ri-home-7-fill"></i>
                        <span>Home</span>
                    </a>
                </li>-->
                
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li class="menu-title">Pages</li>

<!--
                <li>
                    <a href="{{route('employee.all')}}" class="waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Employees Details</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-inbox-archive-line"></i>
                        <span>Manage Category</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li><a href="{{route('category.all')}}">All Categories</a></li>
                        <li><a href="{{route('category.add')}}">Add Category Details</a></li>
                    </ul>
                    
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-archive-fill"></i>
                        <span>Categories Hardware</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li><a href="{{route('keyboard.all')}}">Keyboard</a></li>
                        <li><a href="{{route('mouse.all')}}">Mouse</a></li>
                        <li><a href="{{route('monitor.all')}}">Monitor</a></li>
                        <li><a href="{{route('pc.all')}}">Personal Computer (PC)</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-store-3-line"></i>
                        <span>Manage Inventory</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li><a href="{{route('inventory.all')}}">All Inventories</a></li>
                        <li><a href="{{route('inventory.add')}}">Add Inventory Details</a></li>
                    </ul>      
                </li>

                <li>
                    <a href="{{route('inventory.report')}}" class="waves-effect">
                        <i class="ri-file-list-2-line"></i>
                        <span>Generate Report</span>
                    </a>
                </li>
-->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>