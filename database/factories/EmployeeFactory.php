<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => strtoupper(fake()->firstName()),
            'middle_name' => strtoupper(fake()->lastName()),
            'last_name' => strtoupper(fake()->lastName()),
            'suffix_name' => strtoupper(fake()->suffix()),
            'gender_id' => fake()->numberBetween(1, 3),
            'birth_date' => fake()->date(),
            'age' => fake()->numberBetween(18, 55),
            'address' => strtoupper(fake()->address()),
            'contact_number' => '09' . fake()->randomNumber(9),
            'department_id' => fake()->numberBetween(1, 17),
            'position_id' => fake()->numberBetween(1, 6),
        ];
    }
}
