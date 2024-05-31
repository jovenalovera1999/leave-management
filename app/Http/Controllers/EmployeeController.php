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
            ->get();

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
            'address' => ['required', 'max:55'],
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
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'suffix_name' => $validated['suffix_name'],
            'gender_id' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'age' => $age,
            'address' => $validated['address'],
            'contact_number' => $validated['contact_number'],
            'department_id' => $validated['department'],
            'position_id' => $validated['position'],
        ]);

        return redirect('/employees')->with('success', 'Employee successfully saved.');
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
            'address' => ['required', 'max:55'],
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
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'suffix_name' => $validated['suffix_name'],
            'gender_id' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'age' => $age,
            'address' => $validated['address'],
            'contact_number' => $validated['contact_number'],
            'department_id' => $validated['department'],
            'position_id' => $validated['position'],
        ]);

        return redirect('/employees')->with('success', 'Employee successfully updated.');
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

        return redirect('/employees')->with('success', 'Employee successfully deleted.');
    }
}
