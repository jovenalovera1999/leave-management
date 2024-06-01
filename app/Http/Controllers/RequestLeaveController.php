<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class RequestLeaveController extends Controller
{
    public function create() {
        $employees = Employee::where('tbl_employees.is_deleted', false)
            ->orderBy('tbl_employees.last_name', 'asc')
            ->get();

        return view('request_leave.create', compact('employees'));
    }
}
