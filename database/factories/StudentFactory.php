<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lrn'               => $this->faker->ean8(),
            'employee_id'       => null,
            'rfid_tag'          => $this->faker->ean13(),
            'first_name'        => $this->faker->firstName(),
            'middle_name'       => $this->faker->lastName(),
            'last_name'         => $this->faker->lastName(),
            'suffix'            => $this->faker->randomElement(['Jr.', 'Sr.', 'II', 'III', 'IV', '']),
            'grade_level'       => $this->faker->numberBetween(1, 12),
            'section'           => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']),
            'role_id'           => 5,
            'email'             => $this->faker->email(),
            'password'          => Hash::make('secret'),
            'profile_image'     => $this->faker->imageUrl(),
            'penalty_total'     => 0,
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
