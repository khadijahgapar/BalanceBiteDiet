@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Employee Page</h4><br><br>

                    
                    <form method="post" action="{{route('employee.store')}}" id="myForm">
                        @csrf

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Employee First Name</label>
                        <div class="form-group col-sm-10">
                            <input name="fname" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Employee Last Name</label>
                        <div class="form-group col-sm-10">
                            <input name="lname" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Employee Designation</label>
                        <div class="form-group col-sm-10">
                            <input name="designation" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Employee Email</label>
                        <div class="form-group col-sm-10">
                            <input name="email" class="form-control" type="email" >
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Employee Phone Number</label>
                        <div class="form-group col-sm-10">
                            <input name="phone_no" class="form-control" type="text" >
                        </div>
                    </div>
                    <!-- end row -->

                    

                    <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add Employee">

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
                fname: {
                    required : true,
                },
                lname: {
                    required : true,
                }, 
                designation: {
                    required : true,
                }, 
                email: {
                    required : true,
                }, 
                phone_no: {
                    required : true,
                }, 
            },
            messages :{
                fname: {
                    required : 'Please Enter Your First Name',
                },
                lname: {
                    required : 'Please Enter Your Last Name',
                },
                designation: {
                    required : 'Please Enter Your Designation',
                },
                email: {
                    required : 'Please Enter Your Email',
                },
                phone_no: {
                    required : 'Please Enter Your Phone Number',
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