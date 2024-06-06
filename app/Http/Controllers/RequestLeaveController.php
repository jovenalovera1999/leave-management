<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RequestLeave;
use App\Models\TypesOfLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestLeaveController extends Controller
{
    public function index() {
        $requestLeaves = RequestLeave::select(
                'tbl_request_leaves.request_leave_id',
                'tbl_employees.first_name',
                'tbl_employees.middle_name',
                'tbl_employees.last_name',
                'tbl_employees.suffix_name',
                'tbl_types_of_leave.leave',
                'tbl_types_of_leave.number_of_days',
                'tbl_request_leaves.leave_date_from',
                'tbl_request_leaves.leave_date_to',
                'tbl_request_leaves.created_at',
                DB::raw('number_of_days - (DATEDIFF(tbl_request_leaves.leave_date_to, tbl_request_leaves.leave_date_from) + 1) as remaining_credits'),
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
                $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
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

    public function indexApproved()
    {
        $requestLeaves = RequestLeave::select(
            'tbl_request_leaves.request_leave_id',
            'tbl_employees.first_name',
            'tbl_employees.middle_name',
            'tbl_employees.last_name',
            'tbl_employees.suffix_name',
            'tbl_types_of_leave.leave',
            'tbl_types_of_leave.number_of_days',
            'tbl_request_leaves.leave_date_from',
            'tbl_request_leaves.leave_date_to',
            DB::raw('number_of_days - (DATEDIFF(tbl_request_leaves.leave_date_to, tbl_request_leaves.leave_date_from) + 1) as remaining_credits'),
            'tbl_request_leaves.is_with_pay',
            'tbl_request_leaves.created_at',
        )
            ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->where('tbl_request_leaves.is_approved', true)
            ->where('tbl_request_leaves.is_deleted', false)
            ->orderBy('tbl_request_leaves.created_at', 'desc')
            ->orderBy('tbl_employees.last_name', 'asc');

        if (request()->has('search_text')) {
            $searchText = request()->get('search_text');

            if ($searchText) {
                $requestLeaves = $requestLeaves->where(function ($query) use ($searchText) {
                    $query->where('tbl_employees.first_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.middle_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.last_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.suffix_name', 'like', "%$searchText%")
                    ->orWhere('tbl_types_of_leave.leave', 'like', "%$searchText%");
                });
            }
        }

        if (request()->has('date_from') || request()->has('date_to')) {
            $startDate = request()->get('date_from');
            $endDate = request()->get('date_to');

            if ($startDate && $endDate) {
                $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
                $requestLeaves->whereBetween('tbl_request_leaves.created_at', [$startDate, $endDate]);
            }
        }

        $requestLeaves = $requestLeaves->paginate(25)
            ->appends([
                'search_text' => request()->get('search_text'),
                'date_from' => request()->get('date_from'),
                'date_to' => request()->get('date_to'),
            ]);

        return view('request_leave.approved', compact('requestLeaves'));
    }

    public function indexPending()
    {
        $requestLeaves = RequestLeave::select(
            'tbl_request_leaves.request_leave_id',
            'tbl_employees.first_name',
            'tbl_employees.middle_name',
            'tbl_employees.last_name',
            'tbl_employees.suffix_name',
            'tbl_types_of_leave.leave',
            'tbl_types_of_leave.number_of_days',
            'tbl_request_leaves.leave_date_from',
            'tbl_request_leaves.leave_date_to',
            'tbl_request_leaves.created_at',
            DB::raw('number_of_days - (DATEDIFF(tbl_request_leaves.leave_date_to, tbl_request_leaves.leave_date_from) + 1) as remaining_credits'),
        )
            ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->where('tbl_request_leaves.is_approved', false)
            ->where('tbl_request_leaves.is_deleted', false)
            ->orderBy('tbl_request_leaves.created_at', 'desc')
            ->orderBy('tbl_employees.last_name', 'asc');

        if (request()->has('search_text')) {
            $searchText = request()->get('search_text');

            if ($searchText) {
                $requestLeaves = $requestLeaves->where(function ($query) use ($searchText) {
                    $query->where('tbl_employees.first_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.middle_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.last_name', 'like', "%$searchText%")
                    ->orWhere('tbl_employees.suffix_name', 'like', "%$searchText%")
                    ->orWhere('tbl_types_of_leave.leave', 'like', "%$searchText%");
                });
            }
        }

        if (request()->has('date_from') || request()->has('date_to')) {
            $startDate = request()->get('date_from');
            $endDate = request()->get('date_to');

            if ($startDate && $endDate) {
                $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
                $requestLeaves->whereBetween('tbl_request_leaves.created_at', [$startDate, $endDate]);
            }
        }

        $requestLeaves = $requestLeaves->paginate(25)
            ->appends([
                'search_text' => request()->get('search_text'),
                'date_from' => request()->get('date_from'),
                'date_to' => request()->get('date_to'),
            ]);

        return view('request_leave.pending', compact('requestLeaves'));
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
            'leave' => ['required'],
            'leave_date_from' => ['required', 'date'],
            'leave_date_to' => ['required', 'date'],
        ]);

        $typeOfLeave = TypesOfLeave::where('tbl_types_of_leave.leave_id', $validated['leave'])
            ->first();

        $leaveDateFrom = Carbon::createFromFormat('Y-m-d', $validated['leave_date_from']);
        $leaveDateTo = Carbon::createFromFormat('Y-m-d', $validated['leave_date_to']);
        $numberOfLeaveDays = $leaveDateTo->diffInDays($leaveDateFrom) + 1;

        $remainingCredits = $typeOfLeave->number_of_days - $numberOfLeaveDays;

        if($remainingCredits >= 0) {
            RequestLeave::create([
                'employee_id' => $validated['employee'],
                'leave_id' => $validated['leave'],
                'leave_date_from' => $validated['leave_date_from'],
                'leave_date_to' => $validated['leave_date_to'],
            ]);
        } else {
            return back()->withInput()->with('failed', 'FAILED TO ADD REQUEST LEAVE, REMAINING CREDITS MUST NOT LESS THAN 0.');
        }

        return redirect('/request/leaves')->with('success', 'REQUEST LEAVE SUCCESSFULLY ADDED.');
    }

    public function edit($request_leave_id) {
        $employees = Employee::where('tbl_employees.is_deleted', false)
            ->orderBy('tbl_employees.last_name', 'asc')
            ->get();

        $leaves = TypesOfLeave::where('tbl_types_of_leave.is_deleted', false)
            ->orderBy('tbl_types_of_leave.leave', 'asc')
            ->get();

        $requestLeave = RequestLeave::select(
                    'tbl_request_leaves.request_leave_id',
                    'tbl_employees.employee_id',
                    'tbl_employees.first_name',
                    'tbl_employees.middle_name',
                    'tbl_employees.last_name',
                    'tbl_employees.suffix_name',
                    'tbl_types_of_leave.leave_id',
                    'tbl_types_of_leave.leave',
                    'tbl_request_leaves.leave_date_from',
                    'tbl_request_leaves.leave_date_to',
                    DB::raw('number_of_days - (DATEDIFF(tbl_request_leaves.leave_date_to, tbl_request_leaves.leave_date_from) + 1) as remaining_credits'),
                )
                ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
                ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
                ->find($request_leave_id);

        return view('request_leave.edit', compact('employees', 'leaves', 'requestLeave'));
    }

    public function update(Request $request, RequestLeave $request_leave) {
        $validated = $request->validate([
            'employee' => ['required'],
            'leave' => ['required'],
            'leave_date_from' => ['required', 'date'],
            'leave_date_to' => ['required', 'date'],
        ]);

        $typeOfLeave = TypesOfLeave::where('tbl_types_of_leave.leave_id', $validated['leave'])
            ->first();

        $leaveDateFrom = Carbon::createFromFormat('Y-m-d', $validated['leave_date_from']);
        $leaveDateTo = Carbon::createFromFormat('Y-m-d', $validated['leave_date_to']);
        $numberOfLeaveDays = $leaveDateTo->diffInDays($leaveDateFrom) + 1;

        $remainingCredits = $typeOfLeave->number_of_days - $numberOfLeaveDays;

        if($remainingCredits >= 0) {
            $request_leave->update([
                'employee_id' => $validated['employee'],
                'leave_id' => $validated['leave'],
                'leave_date_from' => $validated['leave_date_from'],
                'leave_date_to' => $validated['leave_date_to'],
            ]);
        } else {
            return back()->withInput()->with('failed', 'FAILED TO UPDATE REQUEST LEAVE, REMAINING CREDITS MUST NOT LESS THAN 0.');
        }


        return back()->with('success', 'REQUEST LEAVE SUCCESSFULLY UPDATED.');
    }

    public function updateToApprovedWithPay(RequestLeave $requestLeave) {
        $requestLeave->update([
            'is_approved' => true,
            'is_with_pay' => true,
        ]);

        return redirect('/request/leaves/pending')->with('success', 'REQUEST LEAVE SUCCESSFULLY APPROVED.');
    }

    public function updateToApprovedWithoutPay(RequestLeave $requestLeave)
    {
        $requestLeave->update([
            'is_approved' => true,
            'is_with_pay' => false,
        ]);

        return redirect('/request/leaves/pending')->with('success', 'REQUEST LEAVE SUCCESSFULLY APPROVED.');
    }

    public function updateToPending(RequestLeave $requestLeave)
    {
        $requestLeave->update([
            'is_approved' => false,
        ]);

        return redirect('/request/leaves/approved')->with('success', 'REQUEST LEAVE SUCCESSFULLY SET TO PENDING.');
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

    public function print($request_leave_id) {
        $requestLeave = RequestLeave::select(
                'tbl_employees.first_name',
                'tbl_employees.middle_name',
                'tbl_employees.last_name',
                'tbl_employees.suffix_name',
                'tbl_departments.department',
                'tbl_positions.position',
                'tbl_types_of_leave.leave',
                'tbl_types_of_leave.number_of_days',
                'tbl_request_leaves.leave_date_from',
                'tbl_request_leaves.leave_date_to',
                'tbl_request_leaves.created_at',
                DB::raw('number_of_days - (DATEDIFF(tbl_request_leaves.leave_date_to, tbl_request_leaves.leave_date_from) + 1) as remaining_credits'),
            )
            ->leftJoin('tbl_employees', 'tbl_request_leaves.employee_id', '=', 'tbl_employees.employee_id')
            ->leftJoin('tbl_departments', 'tbl_employees.department_id', '=', 'tbl_departments.department_id')
            ->leftJoin('tbl_positions', 'tbl_employees.position_id', '=', 'tbl_positions.position_id')
            ->leftJoin('tbl_types_of_leave', 'tbl_request_leaves.leave_id', '=', 'tbl_types_of_leave.leave_id')
            ->find($request_leave_id);

        return view('request_leave.print', compact('requestLeave'));
    }
}
