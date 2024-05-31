<?php

use App\Http\Controllers\EmployeeController;
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
