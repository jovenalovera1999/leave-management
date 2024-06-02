<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RequestLeave;
use App\Models\TypesOfLeave;
use DateTime;
use Illuminate\Http\Request;

class RequestLeaveController extends Controller
{
    public function index() {
        $requestLeaves = RequestLeave::select(
                'tbl_request_leaves.request_leave_id',
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
            ->where('tbl_request_leaves.is_deleted', false)
            ->orderBy('tbl_request_leaves.created_at', 'desc')
            ->orderBy('tbl_employees.last_name', 'asc');

            if(request()->has('search_text')) {
                $searchText = request()->get('search_text');

                if($searchText) {
                    $requestLeaves = $requestLeaves->where(function($query) use($searchText) {
                        $query->where('tbl_employees.first_name', 'like', "%$searchText%")
                            ->orWhere('tbl_employees.middle_name', 'like', "%$searchText%")
                            ->orWhere('tbl_employees.last_name', 'like', "%$searchText%")
                            ->orWhere('tbl_employees.suffix_name', 'like', "%$searchText%")
                            ->orWhere('tbl_types_of_leave.leave', 'like', "%$searchText%");
                    });
                }
            }

            if(request()->has('date_from') || request()->has('date_to')) {
                $startDate = request()->get('date_from');
                $endDate = request()->get('date_to');

                if($startDate && $endDate) {
                    $startDate = DateTime::createFromFormat('Y-m-d', $startDate)->format('Y-m-d 00:00:00');
                    $endDate = DateTime::createFromFormat('Y-m-d', $endDate)->format('Y-m-d 23:59:59');
                    $requestLeaves->whereBetween('tbl_request_leaves.created_at', [$startDate, $endDate]);
                }
            }

            $requestLeaves = $requestLeaves->paginate(25)
                ->appends([
                    'search_text' => request()->get('search_text'),
                    'date_from' => request()->get('date_from'),
                    'date_to' => request()->get('date_to'),
                ]);

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

        return redirect('/request/leaves')->with('success', 'REQUEST LEAVE SUCCESSFULLY ADDED.');
    }

    public function edit($request_leave_id) {
        $employees = Employee::where('tbl_employees.is_deleted', false)
            ->orderBy('tbl_employees.last_name', 'asc')
            ->get();

        $leaves = TypesOfLeave::where('tbl_types_of_leave.is_deleted', false)
            ->orderBy('tbl_types_of_table.leave');

        $requestLeave = RequestLeave::leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->find($request_leave_id);

        return view('request_leave.edit', compact('employees', 'leaves', 'requestLeave'));
    }

    public function update(Request $request, RequestLeave $request_leave) {
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

        $request_leave->update([
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

        return redirect('/request/leaves')->with('success', 'REQUEST LEAVE SUCCESSFULLY UPDATED.');
    }

    public function delete($request_leave_id) {
        $requestLeave = RequestLeave::select(
                'tbl_request_leaves.request_leave_id',
                'tbl_employees.first_name',
                'tbl_employees.middle_name',
                'tbl_employees.last_name',
                'tbl_request_leaves.created_at',
            )
            ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->find($request_leave_id);

        return view('request_leave.delete', compact('requestLeave'));
    }

    public function destroy(RequestLeave $request_leave) {
        $request_leave->update([
            'is_deleted' => true,
        ]);

        return redirect('/request/leaves')->with('success', 'REQUEST LEAVE SUCCESSFULLY DELETED.');
    }
}
