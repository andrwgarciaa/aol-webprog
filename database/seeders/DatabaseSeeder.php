<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserRole::factory()->createMany([
            ['name' => 'Admin'],
            ['name' => 'Lecturer'],
            ['name' => 'Student'],
        ]);

        OrderStatus::factory()->createMany([
            ['name' => 'Cart'],
            ['name' => 'Purchased'],
            ['name' => 'Refunded'],
            ['name' => 'Ongoing'],
            ['name' => 'Completed'],
        ]);

        User::factory()->count(5)->create();
        User::factory()->createMany([
            [
                'name' => 'Lecturer 1',
                'email' => 'lecturer1@lecturer1.com',
                'password' => Hash::make('lecturer1@lecturer1.com'),
                'user_role_id' => 2
            ],
            [
                'name' => 'Student 1',
                'email' => 'student1@student1.com',
                'password' => Hash::make('student1@student1.com'),
                'user_role_id' => 3
            ]
        ]);

        $lecturerIds = User::where('user_role_id', 2)->pluck('id');

        Course::factory()->count(50)->create()->each(function ($course) use ($lecturerIds) {
            $course->lecturer_id = $lecturerIds->random();
            $course->save();
        });

        // $courses = Course::all();

        // foreach ($courses as $course) {
        //     $stepNumber = 1;
        //     CourseDetail::factory()->count(rand(2, 7))->create()->each(function ($courseDetail) use (&$course, &$stepNumber) {
        //         $courseDetail->course_id = $course->id;
        //         $courseDetail->step_number = $stepNumber++;
        //         $courseDetail->save();
        //     });
        // }

        Order::factory()->count(20)->create();
    }
}
