<?php

namespace App\Http\Controllers;

use App\Models\TypesOfLeave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index() {
        $leaves = TypesOfLeave::where('tbl_types_of_leave.is_deleted', false)
            ->orderBy('tbl_types_of_leave.leave', 'asc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $leaves = $leaves->where(function($query) use($searchTerm) {
                    $query->where('tbl_types_of_leave.leave', 'like', "%$searchTerm%");
                });
            }
        }

        $leaves = $leaves->paginate(25)
            ->appends(['search' => request()->get('search')]);

        return view('leave.index', compact('leaves'));
    }

    public function create() {
        return view('leave.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'leave' => ['required', 'max:55'],
            'number_of_days' => ['required', 'numeric'],
        ]);

        TypesOfLeave::create([
            'leave' => strtoupper($validated['leave']),
            'number_of_days' => $validated['number_of_days'],
        ]);

        return redirect('/leaves')->with('success', 'LEAVE SUCCESSFULLY ADDED.');
    }

    public function edit($leave_id) {
        $leave = TypesOfLeave::find($leave_id);
        return view('leave.edit', compact('leave'));
    }

    public function update(Request $request, TypesOfLeave $leave) {
        $validated = $request->validate([
            'leave' => ['required', 'max:55'],
            'number_of_days' => ['required', 'numeric'],
        ]);

        $leave->update([
            'leave' => strtoupper($validated['leave']),
            'number_of_days' => $validated['number_of_days'],
        ]);

        return redirect('/leaves')->with('success', 'LEAVE SUCCESSFULLY UPDATED.');
    }

    public function delete($leave_id) {
        $leave = TypesOfLeave::find($leave_id);
        return view('leave.delete', compact('leave'));
    }

    public function destroy(TypesOfLeave $leave) {
        $leave->update([
            'is_deleted' => true,
        ]);

        return redirect('/leaves')->with('success', 'LEAVE SUCCESSFULLY DELETED.');
    }
}
