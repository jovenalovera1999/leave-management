<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Position;
use DateTime;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::leftJoin('tbl_genders', 'tbl_employees.gender_id', '=', 'tbl_genders.gender_id')
            ->leftJoin('tbl_departments', 'tbl_employees.department_id', '=', 'tbl_departments.department_id')
            ->leftJoin('tbl_positions', 'tbl_employees.position_id', '=', 'tbl_positions.position_id')
            ->where('tbl_employees.is_deleted', false)
            ->orderBy('tbl_employees.last_name', 'asc')
            ->orderBy('tbl_employees.first_name', 'asc')
            ->orderBy('tbl_employees.middle_name', 'asc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $employees = $employees->where(function($query) use($searchTerm) {
                    $query->where('tbl_employees.first_name', 'like', "%$searchTerm%")
                        ->orWhere('tbl_employees.middle_name', 'like', "%$searchTerm%")
                        ->orWhere('tbl_employees.last_name', 'like', "%$searchTerm%")
                        ->orWhere('tbl_genders.gender', 'like', "%$searchTerm%")
                        ->orWhere('tbl_employees.address', 'like', "%$searchTerm%")
                        ->orWhere('tbl_departments.department', 'like', "%$searchTerm%")
                        ->orWhere('tbl_positions.position', 'like', "%$searchTerm%");
                });
            }
        }

        $employees = $employees->paginate(25)
            ->appends(['search' => request()->get('search')]);

        return view('employee.index', compact('employees'));
    }

    public function create() {
        $genders = Gender::all();

        $departments = Department::orderBy('department', 'asc')
            ->get();

        $positions = Position::all();

        return view('employee.create', compact('genders', 'departments', 'positions'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'first_name' => ['required', 'max:55'],
            'middle_name' => ['nullable', 'max:55'],
            'last_name' => ['required', 'max:55'],
            'suffix_name' => ['nullable'],
            'gender' => ['required'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'max:255'],
            'contact_number' => ['required', 'numeric'],
            'department' => ['required'],
            'position' => ['required'],
        ]);

        $birthDate = $validated['birth_date'];

        list($day, $month, $year) = explode('-', $birthDate);
        $birthDate = "$year-$month-$day";

        $birthDate = new DateTime($birthDate);
        $today = new DateTime('today');

        $age = $birthDate->diff($today)->y;

        Employee::create([
            'first_name' => strtoupper($validated['first_name']),
            'middle_name' => strtoupper($validated['middle_name']),
            'last_name' => strtoupper($validated['last_name']),
            'suffix_name' => strtoupper($validated['suffix_name']),
            'gender_id' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'age' => $age,
            'address' => strtoupper($validated['address']),
            'contact_number' => $validated['contact_number'],
            'department_id' => $validated['department'],
            'position_id' => $validated['position'],
        ]);

        return redirect('/employees')->with('success', 'EMPLOYEE SUCCESSFULLY ADDED.');
    }

    public function edit($employee_id) {
        $genders = Gender::all();

        $departments = Department::orderBy('department', 'asc')
            ->get();

        $positions = Position::all();

        $employee = Employee::leftJoin('tbl_genders', 'tbl_employees.gender_id', '=', 'tbl_genders.gender_id')
            ->leftJoin('tbl_departments', 'tbl_employees.department_id', '=', 'tbl_departments.department_id')
            ->leftJoin('tbl_positions', 'tbl_employees.position_id', '=', 'tbl_positions.position_id')
            ->find($employee_id);

        return view('employee.edit', compact('genders', 'departments', 'positions', 'employee'));
    }

    public function update(Request $request, Employee $employee) {
        $validated = $request->validate([
            'first_name' => ['required', 'max:55'],
            'middle_name' => ['nullable', 'max:55'],
            'last_name' => ['required', 'max:55'],
            'suffix_name' => ['nullable'],
            'gender' => ['required'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'max:255'],
            'contact_number' => ['required', 'numeric'],
            'department' => ['required'],
            'position' => ['required'],
        ]);

        $birthDate = $validated['birth_date'];

        list($day, $month, $year) = explode('-', $birthDate);
        $birthDate = "$year-$month-$day";

        $birthDate = new DateTime($birthDate);
        $today = new DateTime('today');

        $age = $birthDate->diff($today)->y;

        $employee->update([
            'first_name' => strtoupper($validated['first_name']),
            'middle_name' => strtoupper($validated['middle_name']),
            'last_name' => strtoupper($validated['last_name']),
            'suffix_name' => strtoupper($validated['suffix_name']),
            'gender_id' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'age' => $age,
            'address' => strtoupper($validated['address']),
            'contact_number' => $validated['contact_number'],
            'department_id' => $validated['department'],
            'position_id' => $validated['position'],
        ]);

        return redirect('/employees')->with('success', 'EMPLOYEE SUCCESSFULLY UPDATED.');
    }

    public function delete($employee_id){
        $employee = Employee::leftJoin('tbl_genders', 'tbl_employees.gender_id', '=', 'tbl_genders.gender_id')
            ->leftJoin('tbl_departments', 'tbl_employees.department_id', '=', 'tbl_departments.department_id')
            ->leftJoin('tbl_positions', 'tbl_employees.position_id', '=', 'tbl_positions.position_id')
            ->find($employee_id);

        return view('employee.delete', compact('employee'));
    }

    public function destroy(Employee $employee) {
        $employee->update([
            'is_deleted' => true,
        ]);

        return redirect('/employees')->with('success', 'EMPLOYEE SUCCESSFULLY DELETED.');
    }
}
