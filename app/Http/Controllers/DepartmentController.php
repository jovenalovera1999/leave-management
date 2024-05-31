<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::where('tbl_departments.is_deleted', false)
            ->orderBy('tbl_departments.department', 'asc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $departments = $departments->where(function($query) use($searchTerm) {
                    $query->where('tbl_departments.department', 'like', "%$searchTerm%");
                });
            }
        }

        $departments = $departments->paginate(25)
            ->appends(['search' => request()->get('search')]);

        return view('department.index', compact('departments'));
    }

    public function create() {
        return view('department.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'department' => ['required', 'max:55'],
        ]);

        Department::create([
            'department' => strtoupper($validated['department']),
        ]);

        return redirect('/departments')->with('success', 'DEPARTMENT SUCCESSFULLY ADDED.');
    }

    public function edit($department_id) {
        $department = Department::find($department_id);
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, Department $department) {
        $validated = $request->validate([
            'department' => ['required', 'max:55'],
        ]);

        $department->update([
            'department' => strtoupper($validated['department']),
        ]);

        return redirect('/departments')->with('success', 'DEPARTMENT SUCCESSFULLY UPDATED.');
    }

    public function delete($department_id) {
        $department = Department::find($department_id);
        return view('department.delete', compact('department'));
    }

    public function destroy(Department $department) {
        $department->update([
            'is_deleted' => true,
        ]);

        return redirect('/departments')->with('success', 'DEPARTMENT SUCCESSFULLY DELETED.');
    }
}
