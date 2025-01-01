<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\EmployeesController;
use App\Http\Controllers\Pos\InventoryController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\KeyboardController;
use App\Http\Controllers\Pos\MouseController;
use App\Http\Controllers\Pos\MonitorController;
use App\Http\Controllers\Pos\PcController;
use App\Http\Controllers\Pos\ReportController;
use App\Http\Controllers\Pos\DashboardController;
use App\Http\Controllers\DietInputController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});


//Admin All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','Profile')->name('admin.profile');
    Route::get('/edit/profile','EditProfile')->name('edit.profile');
    Route::post('/store/profile','StoreProfile')->name('store.profile');

    Route::get('/change/password','ChangePassword')->name('change.password');
    Route::post('/update/password','UpdatePassword')->name('update.password');
});

//Employee All Route
Route::controller(EmployeesController::class)->group(function(){
    
    Route::get('/employee/all','EmployeeAll')->name('employee.all');
    Route::get('/employee/add','EmployeeAdd')->name('employee.add');
    Route::post('/employee/store','EmployeeStore')->name('employee.store');
    Route::get('/employee/edit/{id}','EmployeeEdit')->name('employee.edit');
    Route::post('/employee/update','EmployeeUpdate')->name('employee.update');
    Route::get('/employee/delete/{id}','EmployeeDelete')->name('employee.delete');
});

//Diet All Route
Route::controller(DietInputController::class)->group(function(){

    Route::get('/diet/all','DietInput')->name('balancebite.index');
    Route::post('/balancebite/store','store')->name('balancebite.store');
});



//Category All Route
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/all','CategoryAll')->name('category.all');
    Route::get('/category/add','CategoryAdd')->name('category.add');
    Route::post('/category/store','CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}','CategoryEdit')->name('category.edit');
    Route::post('/category/update','CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}','CategoryDelete')->name('category.delete');
    
    
});
//Inventory All Route
Route::controller(InventoryController::class)->group(function(){
    Route::get('/inventory/all','InventoryAll')->name('inventory.all');
    Route::get('/inventory/add','InventoryAdd')->name('inventory.add');
    Route::post('/inventory/store','InventoryStore')->name('inventory.store');
    Route::get('/inventory/edit/{id}','InventoryEdit')->name('inventory.edit');
    Route::post('/inventory/update','InventoryUpdate')->name('inventory.update');
    Route::get('/inventory/delete/{id}','InventoryDelete')->name('inventory.delete');
});

//Report All Route
Route::controller(ReportController::class)->group(function(){
    Route::get('/inventory/report','InventoryReport')->name('inventory.report'); //Generate Report
    Route::get('/inventory/report/pdf','InventoryReportPdf')->name('inventory.report.pdf');
});

//Keyboard All Route
Route::controller(KeyboardController::class)->group(function(){
    Route::get('/keyboard/all','KeyboardAll')->name('keyboard.all');
    Route::get('/keyboard/add','KeyboardAdd')->name('keyboard.add');
    Route::post('/keyboard/store','KeyboardStore')->name('keyboard.store');
    Route::get('/keyboard/edit/{id}','KeyboardEdit')->name('keyboard.edit');
    Route::post('/keyboard/update','KeyboardUpdate')->name('keyboard.update');
    Route::get('/keyboard/delete/{id}','KeyboardDelete')->name('keyboard.delete');   
});

//Mouse All Route
Route::controller(MouseController::class)->group(function(){
    Route::get('/mouse/all','MouseAll')->name('mouse.all');
    Route::get('/mouse/add','MouseAdd')->name('mouse.add');
    Route::post('/mouse/store','MouseStore')->name('mouse.store');
    Route::get('/mouse/edit/{id}','MouseEdit')->name('mouse.edit');
    Route::post('/mouse/update','MouseUpdate')->name('mouse.update');
    Route::get('/mouse/delete/{id}','MouseDelete')->name('mouse.delete');   
});

//Monitor All Route
Route::controller(MonitorController::class)->group(function(){
    Route::get('/monitor/all','MonitorAll')->name('monitor.all');
    Route::get('/monitor/add','MonitorAdd')->name('monitor.add');
    Route::post('/monitor/store','MonitorStore')->name('monitor.store');
    Route::get('/monitor/edit/{id}','MonitorEdit')->name('monitor.edit');
    Route::post('/monitor/update','MonitorUpdate')->name('monitor.update');
    Route::get('/monitor/delete/{id}','MonitorDelete')->name('monitor.delete');   
});

//PC All Route
Route::controller(PcController::class)->group(function(){
    Route::get('/pc/all','PcAll')->name('pc.all');
    Route::get('/pc/add','PcAdd')->name('pc.add');
    Route::post('/pc/store','PcStore')->name('pc.store');
    Route::get('/pc/edit/{id}','PcEdit')->name('pc.edit');
    Route::post('/pc/update','PcUpdate')->name('pc.update');
    Route::get('/pc/delete/{id}','PcDelete')->name('pc.delete');   
});



//Forgot Password
Route::controller(PasswordResetLinkController::class)->group(function(){
    Route::get('/forgot-password',  'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
