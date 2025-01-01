@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Inventory Page</h4><br><br>

                    
                    <form method="post" action="{{route('inventory.update')}}" id="myForm">
                        @csrf

                        <input type="hidden" name="id" value="{{$inventory->id}}">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Category Name</label>
                        <div class="form-group col-sm-10">
                            <select name="category_id" class="form-select" aria-label="Default select example">
                            
                                <option selected="">Select Category</option>
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}" {{$cate->id == $inventory->category_id ? 'selected' : ''}}>{{$cate->name}}</option>
                                @endforeach

                                <!--@php
                                    $selectedCategory = isset($_POST['category_id']) ? $_POST['category_id'] : null;
                                @endphp-->

                                @if($selectedCategory == 'keyboard_id') <!-- Replace 'keyboard_category_id' with the actual ID for keyboard category -->
                                    <form method="POST" action="{{ route('keyboard.store') }}">
                                        @csrf
                                        <!-- Additional fields for keyboard category -->
                                        <!-- ... -->
                                    </form>
                                @elseif($selectedCategory == 'monitor_id') <!-- Replace 'monitor_category_id' with the actual ID for monitor category -->
                                    <form method="POST" action="{{ route('monitor.store') }}">
                                        @csrf
                                        <!-- Additional fields for monitor category -->
                                        <!-- ... -->
                                    </form>
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Inventory Code</label>
                        <div class="form-group col-sm-10">
                            <input name="code" value="{{$inventory->code}}" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Brand Name</label>
                        <div class="form-group col-sm-10">
                            <input name="brandName" value="{{$inventory->brandName}}" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3" >
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="form-group col-sm-10">
                        <select name="status" class="form-select" aria-label="Default select example" >
                            <option selected="">Select Status</option>
                            <option value="AVAILABLE">AVAILABLE</option>
                            <option value="IN USE">IN USE</option>
                            <option value="DAMAGED">DAMAGED/NOT FUNCTION</option>
                        </select>
                        </div>
                    </div>
                    <!-- end row -->

                    
                    <div class="row mb-3" id=""> <!--  style="display: none;" -->
                    <label class="col-sm-2 col-form-label">User Inventory</label>
                        <div class="form-group col-sm-10">
                            <select name="employee_id" class="form-select" aria-label="Default select example">
            
                                <option selected="">Select Employee</option>
                                <option value="NONE">NONE</option>
                                @foreach($employees as $emplo)
                                <option value="{{$emplo->id}}" {{$emplo->id == $inventory->employee_id ? 'selected' : ''}}>{{$emplo->fname}}</option>
                                @endforeach
                            
                            </select>
                        </div>
                    </div>

                    <!--<script>
                        document.getElementById('status').addEventListener('change', function() {
                            var status = this.value;
                            var selectForm = document.getElementById('selectForm');
                            
                            if (status === '2') { // Checking if status is 'IN USE'
                                selectForm.style.display = 'block'; // Show the form
                            } else {
                                selectForm.style.display = 'none'; // Hide the form
                            }
                        });
                    </script>-->

                    <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Keyboard Inventory">

                    </form>

                    


                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                category_id: {
                    required : true,
                },
                keyCode: {
                    required : true,
                },
                keyName: {
                    required : true,
                },
                
                status: {
                    required : true,
                }, 
                employee_id: {
                    required : true,
                },
                
            },
            messages :{
                category_id: {
                    required : 'Please Choose Category Name',
                },
                keyCode: {
                    required : 'Please Enter Inventory Code ',
                },
                keyName: {
                    required : 'Please Enter Brand Name ',
                },
                status: {
                    required : 'Please Choose Status That Inventory',
                },
                employee_id: {
                    required : 'Please Choose User Inventory',
                },
                
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection