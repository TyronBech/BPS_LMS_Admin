<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     *
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lrn'               => $this->faker->ean13(),
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

    /**
     * Indicate that the model's email address should be unverified.
     *
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }*/
}
