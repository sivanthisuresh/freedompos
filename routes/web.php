<?php

use App\Http\Livewire\Supplier\Suppliers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get("/data",[DataController::class,'index']);
*/

Route::view("/change",'livewire.change.changeview');
Route::view("/report",'livewire.report.reportview');
Route::view("/transaction", 'livewire.transaction.transactionview');
Route::view("/",'livewire.dashboard.dashboardview');
Route::view("/dashboard",'livewire.dashboard.dashboardview');
Route::view('/block','livewire.block.blockview');
Route::view('/account','livewire.account.accountview');
Route::view('/supplier','livewire.supplier.supplierview');
Route::view('/inmate','livewire.inmate.inmateview');
Route::view('/product','livewire.product.productview');
