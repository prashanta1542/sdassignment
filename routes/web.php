<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuperAdminController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [EmployeeController::class, 'loginview']);
Route::get('register', [EmployeeController::class, 'registerview']);
Route::post('log', [EmployeeController::class, 'login']);
Route::post('reg', [EmployeeController::class, 'register']);
Route::get('otpverifypage', [EmployeeController::class, 'otpverifyview']);
Route::post('otpvrify', [EmployeeController::class, 'verified']);


Route::middleware(['isAdminLogin'])->group(function () {
    Route::get('admin/dashboard', [EmployeeController::class, 'admindashboard']);
    Route::get('logout', [EmployeeController::class, 'logout']);
    Route::get('admin/listofemployee',[SuperAdminController::class,'all_employee']);
    Route::get('admin/listofemployee/pending/{id}',[SuperAdminController::class,'pending']);
    Route::get('admin/createdepartment',[SuperAdminController::class,'createdepartmentform']);
    Route::post('admin/makedepartment',[SuperAdminController::class,'makedepartment']);
    Route::get('admin/listofdepartment',[SuperAdminController::class,'listdepartment']);
    Route::get('admin/editdepartment/{id}',[SuperAdminController::class,'editdepartmentform']);
    Route::post('admin/updatedepartment/{id}',[SuperAdminController::class,'updatedepartmentform']);
    Route::get('admin/deletedepartment/{id}',[SuperAdminController::class,'deletedepartment']);
});



Route::middleware(['isDepartmentAdminLogin'])->group(function () {
    Route::get('dapartment/dashboard',[EmployeeController::class,'departmentadminhome']);
    Route::get('logout', [EmployeeController::class, 'logout']);
});

Route::get('teacher/dashboard',[EmployeeController::class,'teacherdashboard']);