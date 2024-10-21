<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\StudentDetails;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 users and for each user create a student detail
        Users::factory(50)->create()->each(function ($users) {
            // Create a StudentDetails record for each user
            $users->studentDetails()->save(StudentDetails::factory()->make());
        });
    }
}
