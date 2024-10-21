<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Users;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentDetails>
 */
class StudentDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>
            Users::factory(), // This will create a user automatically
            'firstname' => fake()->firstName,
            'middlename' => fake()->firstName,
            'lastname' => fake()->lastName,
            'dob' => fake()->date(),
            'class_id' => fake()->numberBetween(1, 10),
            'religion' => fake()->randomElement(['Christian', 'Islam', 'Others']),
            'address' => fake()->address,
            'blood_group' => fake()->randomElement(['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-']),
            'height' => fake()->numberBetween(140, 200),
            'weight' => fake()->numberBetween(40, 100),
            'measurement_date' => fake()->date(),
        ];
    }
}
