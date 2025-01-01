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
use Auth;
use Illuminate\Support\Carbon;

class MouseController extends Controller
{
    //
    public function MouseAll(Request $request){
        //$mouses = Mouse::all();
        
        $search = $request->input('search');

        $mouses = Mouse::where(function ($query) use ($search) {
            $query->where('mouseCode', 'like', '%' . $search . '%')
                ->orWhere('mouseName', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('employee_id', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        //$mouses = Mouse::latest()->paginate(10);

        
        return view('backend.mouse.mouse_all',compact('mouses','search'));

    }//End Method

    public function MouseAdd(){
        
        $category = Category::all();
        $employees = User::all();
        $inventory = Inventory::all();
        return view('backend.mouse.mouse_add',compact('category','employees','inventory'));

    }//End Method

    public function MouseStore(Request $request){
        
        $inventoryId = $request->inventory_id;
        
        Mouse::insert([
            'inventory_id' =>$inventoryId,
            'mouseCode' =>$request->mouseCode,
            'mouseName' =>$request->mouseName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Mouse Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('mouse.all')->with($notification);

    }//End Method

    public function MouseEdit($id){
        
        $mouse = Mouse::findOrFail($id);
        $inventory = Inventory::all();
        $category = Category::all();
        $employees = Employee::all();
        return view('backend.mouse.mouse_edit',compact('mouse'));

    }//End Method

    public function MouseUpdate(Request $request){
        
        $mouse_id = $request->id;

        Mouse::findOrFail($mouse_id)->update([
            'mouseCode' =>$request->mouseCode,
            'mouseName' =>$request->mouseName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Mouse Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('mouse.all')->with($notification);
        return redirect()->route('inventory.all')->with($notification);

    }//End Method

    public function MouseDelete($id){
        
        Mouse::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Inventory Mouse Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
}
