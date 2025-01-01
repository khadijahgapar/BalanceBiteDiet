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

class PcController extends Controller
{
    //
    public function PcAll(Request $request){
        //$pcs = Pc::all();
        
        $search = $request->input('search');

        $pcs = Pc::where(function ($query) use ($search) {
            $query->where('pcCode', 'like', '%' . $search . '%')
                ->orWhere('pcName', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('employee_id', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        //$pcs = Pc::latest()->paginate(10);

        
        return view('backend.pc.pc_all',compact('pcs','search'));

    }//End Method

    public function PcAdd(){
        
        $category = Category::all();
        $employees = User::all();
        $inventory = Inventory::all();
        return view('backend.pc.pc_add',compact('category','employees','inventory'));

    }//End Method

    public function PcStore(Request $request){
        
        $inventoryId = $request->inventory_id;
        
        Pc::insert([
            'inventory_id' =>$inventoryId,
            'pcCode' =>$request->pcCode,
            'pcName' =>$request->pcName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'PC Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('pc.all')->with($notification);

    }//End Method

    public function PcEdit($id){
        
        $pc = Pc::findOrFail($id);
        return view('backend.pc.pc_edit',compact('pc'));

    }//End Method

    public function PcUpdate(Request $request){
        
        $pc_id = $request->id;

        Pc::findOrFail($pc_id)->update([
            'pcCode' =>$request->pcCode,
            'pcName' =>$request->pcName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'PC Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('pc.all')->with($notification);

    }//End Method

    public function PcDelete($id){
        
        Pc::findOrFail($id)->delete();
        $notification = array(
            'message' => 'PC Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
}
