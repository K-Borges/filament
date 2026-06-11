<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),

            'description' => fake()->paragraph(),

            'price' => fake()->randomFloat(2, 10, 5000),

            'stock' => fake()->numberBetween(0, 100),

            'category_id' => Category::inRandomOrder()->first()->id,

        
        ];
    }
}