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

class KeyboardController extends Controller
{
    //
    public function KeyboardAll(Request $request){
        //$keyboards = Keyboard::all();
        
        $search = $request->input('search');

        $keyboards = Keyboard::where(function ($query) use ($search) {
            $query->where('keyCode', 'like', '%' . $search . '%')
                ->orWhere('keyName', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('employee_id', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        //$keyboards = Keyboard::latest()->paginate(10);

        
        return view('backend.keyboard.keyboard_all',compact('keyboards','search'));

    }//End Method

    public function KeyboardAdd(){
        
        $category = Category::all();
        $employees = User::all();
        $inventory = Inventory::all();
        return view('backend.keyboard.keyboard_add',compact('category','employees','inventory'));

    }//End Method

    public function KeyboardStore(Request $request){
        
        // Use $request or session data to retrieve the inventory_id
        $inventoryId = $request->inventory_id; // Assuming you have inventory_id in your form
        
        Keyboard::insert([
            'inventory_id' =>$inventoryId,
            'keyCode' =>$request->keyCode,
            'keyName' =>$request->keyName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Keyboard Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('keyboard.all')->with($notification);

    }//End Method

    public function KeyboardEdit($id){
        
        $keyboard = Keyboard::findOrFail($id);
        $inventory = Inventory::all();
        $category = Category::all();
        $employees = Employee::all();
        return view('backend.keyboard.keyboard_edit',compact('keyboard'));

    }//End Method

    public function KeyboardUpdate(Request $request){
        
        $keyboard_id = $request->id;

        Keyboard::findOrFail($keyboard_id)->update([
            'keyCode' =>$request->keyCode,
            'keyName' =>$request->keyName,
            'status' =>$request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Keyboard Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('keyboard.all')->with($notification);
        return redirect()->route('inventory.all')->with($notification);

    }//End Method

    public function KeyboardDelete($id){
        
        Keyboard::findOrFail($id)->delete();
        //$inventoryId = $inventory->inventory_id;
        //Inventory::findOrFail($inventoryId)->delete();
        //Inventory::where('inventory_id', $id)->delete();
        
        $notification = array(
            'message' => 'Inventory Keyboard Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
}
