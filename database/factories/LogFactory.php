<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => $this->faker->numberBetween(31, 133),
            'timestamp'     => $this->faker->dateTimeThisYear,
            'actiontype'    => $this->faker->randomElement(['Time In', 'Time Out']),
            'created_at'    => $this->faker->dateTimeThisYear,
            'updated_at'    => $this->faker->dateTimeThisYear,
        ];
    }
}
