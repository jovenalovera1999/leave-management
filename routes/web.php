<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RequestLeaveController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function() {
    Route::get('/', 'index')->name('login');
    Route::post('/process/login', 'processLogin');
});

Route::group(['middleware' => 'auth'], function() {
    Route::controller(UserController::class)->group(function() {
        Route::post('/process/logout', 'processLogout');
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

    Route::controller(LeaveController::class)->group(function() {
        Route::get('/leaves', 'index');
        Route::get('/leave/create', 'create');
        Route::get('/leave/edit/{leave_id}', 'edit');
        Route::get('/leave/delete/{leave_id}', 'delete');

        Route::post('/leave/store', 'store');
        Route::put('/leave/update/{leave}', 'update');
        Route::delete('/leave/destroy/{leave}', 'destroy');
    });

    Route::controller(RequestLeaveController::class)->group(function() {
        Route::get('/request/leaves', 'index');
        Route::get('/request/leaves/approved', 'indexApproved');
        Route::get('/request/leaves/pending', 'indexPending');
        Route::get('/request/leave/create', 'create');
        Route::get('/request/leave/edit/{request_leave_id}', 'edit');
        Route::get('/request/leave/delete/{request_leave_id}', 'delete');
        Route::get('/request/leave/approved/print/{request_leave_id}', 'print');

        Route::post('/request/leave/store', 'store');
        Route::put('/leave/request/update/to/approved/with/pay/{request_leave}', 'updateToApprovedWithPay');
        Route::put('/leave/request/update/to/approved/without/pay/{request_leave}', 'updateToApprovedWithoutPay');
        Route::put('/leave/request/update/to/pending/{request_leave}', 'updateToPending');
        Route::put('/request/leave/update/{request_leave}', 'update');
        Route::delete('/request/leave/destroy/{request_leave}', 'destroy');
    });
});

