<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Employee;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    //
    public function CategoryAll(Request $request){
        //$categories = Category::all();

        $search = $request->input('search');

        $categories = Category::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('qty', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        // Calculate quantity for each category
        // Calculate quantity for each category
        $keyboardQuantity = Inventory::whereHas('category', function ($query) {
            $query->where('name', 'Keyboard');
        })->count();

        $mouseQuantity = Inventory::whereHas('category', function ($query) {
            $query->where('name', 'Mouse');
        })->count();

        $monitorQuantity = Inventory::whereHas('category', function ($query) {
            $query->where('name', 'Monitor');
        })->count();

        $pcQuantity = Inventory::whereHas('category', function ($query) {
            $query->where('name', 'Personal Computer (PC)');
        })->count();

        return view('backend.category.category_all', compact('categories','search','keyboardQuantity', 'mouseQuantity', 'monitorQuantity', 'pcQuantity'));
        
    }//End Method

    // Helper method to get category quantity
    /*private function getCategoryQuantity($categoryName) {
    return Inventory::whereHas('category', function ($query) use ($categoryName) {
        $query->where('name', $categoryName);
    })->count();
    }*/

    public function CategoryAdd(){
        
        return view('backend.category.category_add');

    }//End Method

    public function CategoryStore(Request $request){
        
        Category::insert([
            'name' =>$request->name,
            'qty' =>$request->qty,
            'description' =>$request->description,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('category.all')->with($notification);

    }//End Method

    public function CategoryEdit($id){
        
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));

    }//End Method

    public function CategoryUpdate(Request $request){
        
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'name' =>$request->name,
            'qty' =>$request->qty,
            'description' =>$request->description,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('category.all')->with($notification);

    }//End Method

    public function CategoryDelete($id){
        
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' =>'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

}
