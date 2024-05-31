<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/employees', 'index');
    Route::get('/employee/create', 'create');
    Route::get('/employee/edit/{employee_id}', 'edit');
    Route::get('/employee/delete/{employee_id}', 'delete');

    Route::post('/employee/store', 'store');
    Route::put('/employee/update/{employee}', 'update');
    Route::delete('/employee/destroy/{employee}', 'destroy');
});

Route::controller(DepartmentController::class)->group(function() {
    Route::get('/departments', 'index');
    Route::get('/department/create', 'create');
    Route::get('/department/edit/{department_id}', 'edit');
    Route::get('/department/delete/{department_id}', 'delete');

    Route::post('/department/store', 'store');
    Route::put('/department/update/{department}', 'update');
    Route::delete('/department/destroy/{department}', 'destroy');
});

Route::controller(PositionController::class)->group(function() {
    Route::get('/positions', 'index');
    Route::get('/position/create', 'create');
    Route::get('/position/edit/{position_id}', 'edit');
    Route::get('/position/delete/{position_id}', 'delete');

    Route::post('/position/store', 'store');
    Route::put('/position/update/{position}', 'update');
    Route::delete('/position/destroy/{position}', 'destroy');
});
