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
use Illuminate\Pagination\LengthAwarePaginator;

class InventoryController extends Controller
{
    //

    public function InventoryAll(Request $request){
        //$inventories = Inventory::all();
        //$inventories = Inventory::latest()->paginate(10);
        $search = $request->input('search');

        $inventories = Inventory::where(function ($query) use ($search) {
            $query->where('code', 'like', '%' . $search . '%')
                ->orWhere('brandName', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('employee_id', 'like', '%' . $search . '%');
        })->latest()->paginate(10);
        //$inventories = Inventory::with('user')->latest()->paginate(10);
        // Count all the inventories without any specific condition
        $quantity = Inventory::count();

        return view('backend.inventory.inventory_all',compact('inventories','quantity','search'));

    }//End Method

    public function InventoryAdd(){
        
        $category = Category::all();
        $users = User::all();
        $keyboard = Keyboard::all();
        $mouse = Mouse::all();
        $monitor = Monitor::all();
        $pc = Pc::all();
        return view('backend.inventory.inventory_add',compact('category','users','keyboard','mouse','monitor','pc'));

    }//End Method

    public function InventoryStore(Request $request){
        
        $category = Category::findOrFail($request->category_id); // Fetch the selected category

        //Check if the selected value for employee_id is 'NONE'
        $userId = $request->employee_id === 'NONE' ? null : $request->employee_id;

        // Second choice Check if the selected value for employee_id is 'NONE'
        
        /*if ($request->employee_id === 'NONE') {
            $employeeId = null; // If 'NONE' is selected, set employee_id to null
        } else {
            $employeeId = $request->employee_id; // Set employee_id to the selected value
        }*/


        //relationship with each categories and inventoryID
        $inventoryId = Inventory::insertGetId([  //to store id give the data
            'code' =>$request->code,
            'brandName' =>$request->brandName,
            'category_id' =>$request->category_id,
            'status' =>$request->status,
            'employee_id' =>$userId, // Set employee_id to null or the selected value
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Inserted Successfully',
            'alert-type' =>'success'
        );

        //if else statement to selected category to store 
        if ($category->name === 'Keyboard') {
            // Code to execute if the choice is 'option1'
            Keyboard::insert([
                'inventory_id' => $inventoryId,
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'keyCode' =>$request->code, // Example usage for code in keyboard table
                'keyName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('keyboard.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Mouse') {
            // Code to execute if the choice is 'option2'
            Mouse::insert([
                'inventory_id' => $inventoryId,
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'mouseCode' =>$request->code, // Example usage for code in keyboard table
                'mouseName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('mouse.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Monitor') {
            // Code to execute if the choice is 'option2'
            Monitor::insert([
                'inventory_id' => $inventoryId,
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'monCode' =>$request->code, // Example usage for code in keyboard table
                'monName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('monitor.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Personal Computer (PC)') {
            // Code to execute if the choice is 'option2'
            Pc::insert([
                'inventory_id' => $inventoryId,
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'pcCode' =>$request->code, // Example usage for code in keyboard table
                'pcName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('pc.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);
        } else {
            // Code to execute if none of the above conditions are met   
        }
        return redirect()->route('dash')->with($notification);

    }//End Method

    public function InventoryEdit($id){
        
        $inventory = Inventory::findOrFail($id);
        $category = Category::all();
        $users = User::all();
        $keyboard = Keyboard::all();
        $mouse = Mouse::all();
        $monitor = Monitor::all();
        $pc = Pc::all();
        return view('backend.inventory.inventory_edit',compact('category','users','inventory'));

    }//End Method

    public function InventoryUpdate(Request $request){
        
        $category = Category::findOrFail($request->category_id); // Fetch the selected category
        $inventory_id = $request->id;

        //Check if the selected value for employee_id is 'NONE'
        $userId = $request->employee_id === 'NONE' ? null : $request->employee_id;

        Inventory::findOrFail($inventory_id)->update([
            'code' =>$request->code,
            'brandName' =>$request->brandName,
            'category_id' =>$request->category_id,
            'status' =>$request->status,
            'employee_id' =>$userId,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Inventory Updated Successfully',
            'alert-type' =>'success'
        );

        if ($category->name === 'Keyboard') {
            // Code to execute if the choice is 'option1'
            Keyboard::where('inventory_id', $inventory_id)->update([
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'keyCode' =>$request->code, // Example usage for code in keyboard table
                'keyName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('keyboard.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Mouse') {
            // Code to execute if the choice is 'option2'
            Mouse::where('inventory_id', $inventory_id)->update([
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'mouseCode' =>$request->code, // Example usage for code in keyboard table
                'mouseName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('mouse.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Monitor') {
            // Code to execute if the choice is 'option2'
            Monitor::where('inventory_id', $inventory_id)->update([
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'monCode' =>$request->code, // Example usage for code in keyboard table
                'monName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('monitor.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else if ($category->name === 'Personal Computer (PC)') {
            // Code to execute if the choice is 'option2'
            Pc::where('inventory_id', $inventory_id)->update([
                'employee_id' =>$userId,
                'category_id' =>$request->category_id,
                'pcCode' =>$request->code, // Example usage for code in keyboard table
                'pcName'=>$request->brandName,
                'status'=>$request->status,// Other fields specific to the keyboard table
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('pc.all')->with($notification);
            return redirect()->route('inventory.all')->with($notification);

        } else {
            // Code to execute if none of the above conditions are met
            return 'Invalid choice';
        }


    }//End Method

    public function InventoryDelete(Request $request, $id){
        
        // Find the Inventory record
        $inventory = Inventory::findOrFail($id);
        // Store the category ID from the inventory
        $categoryId = $inventory->category_id;
        // Delete the inventory
        $inventory->delete();
  
        $category = Category::findOrFail($categoryId);

        $notification = array(
            'message' => 'Inventory Delete Successfully',
            'alert-type' =>'success'
        );

        if ($category->name === 'Keyboard') {
            // Code to execute if the choice is 'option1'
            // Delete the Keyboard record based on the same $id
            Keyboard::where('inventory_id', $id)->delete();
    
            // Redirect back with success message
            return redirect()->back()->with($notification);
                
            //return redirect()->route('keyboard.delete', ['id' => $id])->back()->with($notification);

        } else if ($category->name === 'Mouse') {
            // Code to execute if the choice is 'option2'
            Mouse::where('inventory_id', $id)->delete();
            return redirect()->back()->with($notification);

        } else if ($category->name === 'Monitor') {
            // Code to execute if the choice is 'option2'
            Monitor::where('inventory_id', $id)->delete();
            return redirect()->back()->with($notification);

        } else if ($category->name === 'Personal Computer (PC)') {
            // Code to execute if the choice is 'option2'
            Pc::where('inventory_id', $id)->delete();
            return redirect()->back()->with($notification);

        } else {
            // Code to execute if none of the above conditions are met
            return 'Invalid choice';
        }
        return redirect()->back()->with($notification);
        
    }//End Method

}
