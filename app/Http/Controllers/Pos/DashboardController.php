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

class DashboardController extends Controller
{
    //
    public function show() {

        $dashboard = Inventory::latest()->get();

        //Total Inventories & percentage//
        $quantity = Inventory::count();// Get the total inventories for the current period
       
        $inUseCount = Inventory::where('status', 'IN USE')->count();
        
        // Calculate the percentage
        $inUsePercentage = ($inUseCount / $quantity) * 100;
        
        //End Total inventories//




        //Total Employee & previous period percentage//
        $totalUsers = User::count();

        // Get inventories for the previous period (adjust the time period as needed)
        $previousPeriodEmployees = User::where('created_at', '>=', Carbon::now()->subMonths(1))
                                            ->where('created_at', '<', Carbon::now())
                                            ->get();

        // Calculate the count difference in percentage
        $countDifferencePercentage = 0;
        //$currentCount = $totalEmployees->count();
        $previousCount = $previousPeriodEmployees->count();

        if ($previousCount > 0) {
            $countDifferencePercentage = (($totalUsers - $previousCount) / $previousCount) * 100;
        }

        //Percentage each category
        $totalKeyboard = Keyboard::count();
        $availableK = Keyboard::where('status', 'AVAILABLE')->count();
        // Calculate the percentage
        $keyboardPercentage = number_format(($availableK / $totalKeyboard) * 100, 1);

        $totalMouse = Mouse::count();
        $availableMou = Mouse::where('status', 'AVAILABLE')->count();
        // Calculate the percentage
        $mousePercentage = number_format(($availableMou / $totalMouse) * 100, 1);

        $totalMonitor = Monitor::count();
        $availableMo = Monitor::where('status', 'AVAILABLE')->count();
        // Calculate the percentage
        $monitorPercentage = number_format(($availableMo / $totalMonitor) * 100, 1);

        $totalPc = Pc::count();
        $availablePc = Pc::where('status', 'AVAILABLE')->count();
        // Calculate the percentage
        $pcPercentage = number_format(($availablePc / $totalPc) * 100, 1);




        
 
        return view('admin.index', compact('dashboard', 'quantity','inUsePercentage','totalUsers','countDifferencePercentage',
        'keyboardPercentage','mousePercentage','monitorPercentage','pcPercentage','availableK','totalKeyboard','availableMou',
        'totalMouse','availableMo','totalMonitor','availablePc','totalPc'));
    }//End Method
    
}
