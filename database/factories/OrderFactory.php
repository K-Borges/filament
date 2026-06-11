<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,

            'status' => fake()->randomElement([
                'pending',
                'paid',
                'cancelled',
            ]),

            'total_price' => 0,
        ];
    }
}