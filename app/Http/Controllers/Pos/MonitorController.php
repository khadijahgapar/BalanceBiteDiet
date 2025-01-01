<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Keyboard;
use App\Models\Mouse;
use App\Models\Monitor;
use App\Models\Pc;
use Auth;
use Illuminate\Support\Carbon;

class MonitorController extends Controller
{
    //
    public function MonitorAll(Request $request){
        //$monitors = Monitor::all();
        $totalMonitor = Monitor::count();
        $available = Monitor::where('status', 'AVAILABLE')->count();
        // Calculate the percentage
        $monitorPercentage = ($available / $totalMonitor) * 100;

        $search = $request->input('search');

        $monitors = Monitor::where(function ($query) use ($search) {
            $query->where('monCode', 'like', '%' . $search . '%')
                ->orWhere('monName', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('employee_id', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        
        return view('backend.monitor.monitor_all',compact('monitors','search'));

    }//End Method

    public function MonitorAdd(){
        
        $category = Category::all();
        $employees = User::all();
        $inventory = Inventory::all();
        return view('backend.monitor.monitor_add',compact('category','employees','inventory'));

    }//End Method

    public function MonitorStore(Request $request){
        
        $inventoryId = $request->inventory_id;
        
        Monitor::insert([
            'inventory_id' =>$inventoryId,
            'monCode' =>$request->monCode,
            'monName' =>$request->monName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Monitor Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('monitor.all')->with($notification);

    }//End Method

    public function MonitorEdit($id){
        
        $monitor = Monitor::findOrFail($id);
        return view('backend.monitor.monitor_edit',compact('monitor'));

    }//End Method

    public function MonitorUpdate(Request $request){
        
        $monitor_id = $request->id;

        Monitor::findOrFail($monitor_id)->update([
            'monCode' =>$request->monCode,
            'monName' =>$request->monName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Monitor Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('monitor.all')->with($notification);

    }//End Method

    public function MonitorDelete($id){
        
        Monitor::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Monitor Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
}
