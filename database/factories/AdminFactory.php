<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_lname' => $this->faker->lastName,
            'admin_fname' => $this->faker->firstName,
            'admin_mi' => $this->faker->randomLetter,
            'employee_id' => $this->faker->unique()->randomNumber,
            'admin_contact' => $this->faker->numerify('###########'), // Generates 11 digits
            'email' => $this->faker->unique()->safeEmail,
            // 'admintype_id' => \App\Models\AdminType::factory(), // Assuming you have an AdminType factory
            // 'office_id' => \App\Models\Office::factory(), // Assuming you have an Office factory
            'position_id' => $this->faker->randomNumber,
            'password' => bcrypt('password'), // Default password for all admins (change as needed)
            'remember_token' => Str::random(10),
        ];
    }
}
