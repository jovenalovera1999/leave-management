<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RequestLeave;
use App\Models\TypesOfLeave;
use Illuminate\Http\Request;

class RequestLeaveController extends Controller
{
    public function index() {
        $requestLeaves = RequestLeave::select(
                'tbl_employees.first_name',
                'tbl_employees.middle_name',
                'tbl_employees.last_name',
                'tbl_employees.suffix_name',
                'tbl_request_leaves.regular_salary',
                'tbl_request_leaves.regular_schedule_date_from',
                'tbl_request_leaves.regular_schedule_date_to',
                'tbl_types_of_leave.leave',
                'tbl_request_leaves.leave_date_from',
                'tbl_request_leaves.leave_date_to',
                'tbl_request_leaves.attended_date_from',
                'tbl_request_leaves.attended_date_to',
                'tbl_request_leaves.salary_deduction_per_day',
                'tbl_request_leaves.deducted_salary',
                'tbl_request_leaves.final_salary',
                'tbl_request_leaves.created_at',
            )
            ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->where('tbl_request_leaves.is_deleted', false);

            if(request()->has('search')) {
                $searchTerm = request()->get('search');

                if($searchTerm) {
                    $requestLeaves = $requestLeaves->where(function($query) use($searchTerm) {
                        $query->where('tbl_employees.first_name', 'like', "%$searchTerm%")
                            ->orWhere('tbl_employees.middle_name', 'like', "%$searchTerm%")
                            ->orWhere('tbl_employees.last_name', 'like', "%$searchTerm%")
                            ->orWhere('tbl_employees.suffix_name', 'like', "%$searchTerm%")
                            ->orWhere('tbl_types_of_leave.leave', 'like', "%$searchTerm%");
                    });
                }
            }

            $requestLeaves = $requestLeaves->paginate(25)
                ->appends(['search' => request()->get('search')]);

        return view('request_leave.index', compact('requestLeaves'));
    }

    public function create() {
        $employees = Employee::where('tbl_employees.is_deleted', false)
            ->orderBy('tbl_employees.last_name', 'asc')
            ->get();

        $leaves = TypesOfLeave::where('tbl_types_of_leave.is_deleted', false)
            ->orderBy('tbl_types_of_leave.leave', 'asc')
            ->get();

        return view('request_leave.create', compact('employees', 'leaves'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'employee' => ['required'],
            'regular_salary' => ['required', 'numeric'],
            'regular_schedule_date_from' => ['required', 'date'],
            'regular_schedule_date_to' => ['required', 'date'],
            'leave' => ['required'],
            'leave_date_from' => ['required', 'date'],
            'leave_date_to' => ['required', 'date'],
            'attended_date_from' => ['nullable', 'date'],
            'attended_date_to' => ['nullable', 'date'],
            'salary_deduction_per_day' => ['nullable', 'numeric'],
            'deducted_salary' => ['nullable', 'numeric'],
            'final_salary' => ['nullable', 'numeric'],
        ]);

        RequestLeave::create([
            'employee_id' => $validated['employee'],
            'regular_salary' => $validated['regular_salary'],
            'regular_schedule_date_from' => $validated['regular_schedule_date_from'],
            'regular_schedule_date_to' => $validated['regular_schedule_date_to'],
            'leave_id' => $validated['leave'],
            'leave_date_from' => $validated['leave_date_from'],
            'leave_date_to' => $validated['leave_date_to'],
            'attended_date_from' => $validated['attended_date_from'],
            'attended_date_to' => $validated['attended_date_to'],
            'salary_deduction_per_day' => $validated['salary_deduction_per_day'],
            'deducted_salary' => $validated['deducted_salary'],
            'final_salary' => $validated['final_salary'],
        ]);

        return redirect('/leaves')->with('success', 'REQUEST LEAVE SUCCESSFULLY ADDED.');
    }
}
