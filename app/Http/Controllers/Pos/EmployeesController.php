<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeesController extends Controller
{
    //

    public function EmployeeAll(Request $request){
        //$employees = Employee::all();

        $search = $request->input('search');

        $employees = User::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('designation', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone_no', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        //$employees = User::latest()->paginate(10); // Use paginate instead of latest()->get();
        return view('backend.employee.employee_all',compact('employees','search'));

    }//End Method

    public function EmployeeAdd(){
        
        return view('backend.employee.employee_add');

    }//End Method

    public function EmployeeStore(Request $request){
        
        User::insert([
            
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('employee.all')->with($notification);

    }//End Method

    public function EmployeeEdit($id){
        
        $employee = User::findOrFail($id);
        return view('backend.employee.employee_edit',compact('employee'));

    }//End Method

    public function EmployeeUpdate(Request $request){
        
        $employee_id = $request->id;

        User::findOrFail($employee_id)->update([
            
            'name' =>$request->name,
            'designation' =>$request->designation,
            'email' =>$request->email,
            'phone_no' =>$request->phone_no,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('employee.all')->with($notification);

    }//End Method

    public function EmployeeDelete($id){
        
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Employee Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
}

