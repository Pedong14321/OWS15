<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_lname' => $this->faker->lastName,
            'student_fname' => $this->faker->firstName,
            'student_picture' => $this->faker->imageUrl(),
            'course_id' => 1,
            'email' => $this->faker->unique()->safeEmail,
            'google_id' => Str::limit($this->faker->uuid, 6),
        ];
    }
}
