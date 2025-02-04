<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => $this->faker->numberBetween(1, 104),
            'copy_id'           => $this->faker->numberBetween(1, 100),
            'transaction_type'  => $this->faker->randomElement(['Borrow', 'Return']),
            'date_borrowed'     => $this->faker->dateTimeThisYear,
            'due_date'          => $this->faker->dateTimeThisYear,
            'return_date'       => $this->faker->dateTimeThisYear,
            'num_read'          => $this->faker->numberBetween(1, 10),
            'created_at'        => $this->faker->dateTimeThisYear,
            'updated_at'        => $this->faker->dateTimeThisYear
        ];
    }
}
