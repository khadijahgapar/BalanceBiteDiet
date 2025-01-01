<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Keyboard;
use App\Models\Mouse;
use App\Models\Monitor;
use App\Models\Pc;
use Auth;
use Illuminate\Support\Carbon;


class ReportController extends Controller
{
    //
    public function InventoryReport(){
        $allData = Inventory::orderBy('employee_id','asc')->orderby('category_id','asc')->paginate(10);
        return view('backend.inventory.inventory_report',compact('allData'));

    }//End Method

    public function InventoryReportPdf(){
        $allData = Inventory::orderBy('employee_id','asc')->orderby('category_id','asc')->get();
        return view('backend.inventory.inventory_report_pdf',compact('allData'));

    }//End Method
}
