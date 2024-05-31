<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Gender;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Gender::factory()->create([
            'gender' => 'MALE',
        ]);

        Gender::factory()->create([
            'gender' => 'FEMALE',
        ]);

        Gender::factory()->create([
            'gender' => 'PREFER NOT TO SAY',
        ]);

        Department::factory()->create([
            'department' => 'CSS',
        ]);

        Department::factory()->create([
            'department' => 'CCJE',
        ]);

        Department::factory()->create([
            'department' => 'CASHIER',
        ]);

        Department::factory()->create([
            'department' => 'REGISTRAR',
        ]);

        Department::factory()->create([
            'department' => 'CAS',
        ]);

        Department::factory()->create([
            'department' => 'CHRMT',
        ]);

        Department::factory()->create([
            'department' => 'CTE',
        ]);

        Department::factory()->create([
            'department' => 'KINDERGARTEN',
        ]);

        Department::factory()->create([
            'department' => 'ELEMENTARY',
        ]);

        Department::factory()->create([
            'department' => 'JUNIOR HIGH SCHOOL',
        ]);

        Department::factory()->create([
            'department' => 'SENIOR HIGH SCHOOL',
        ]);

        Department::factory()->create([
            'department' => 'ECE',
        ]);

        Department::factory()->create([
            'department' => 'CBA',
        ]);

        Department::factory()->create([
            'department' => 'NURSING',
        ]);

        Department::factory()->create([
            'department' => 'MAINTENANCE',
        ]);

        Department::factory()->create([
            'department' => 'HR',
        ]);

        Department::factory()->create([
            'department' => 'OFFICE OF THE PRESIDENT',
        ]);

        Position::factory()->create([
            'position' => 'DEAN',
        ]);

        Position::factory()->create([
            'position' => 'SECRETARY',
        ]);

        Position::factory()->create([
            'position' => 'REGULAR STAFF',
        ]);

        Position::factory()->create([
            'position' => 'PART-TIME STAFF',
        ]);

        Position::factory()->create([
            'position' => 'FULL-TIME FACULTY',
        ]);

        Position::factory()->create([
            'position' => 'PART-TIME FACULTY',
        ]);
    }
}
