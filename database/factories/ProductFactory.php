<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> fake()->unique()->word(),
            "price" => fake()->randomFloat(2, 10, 1000),
            "stock" => fake()->numberBetween(1, 100),
            "description" => fake()->sentence(),
            "category_id" => Category::inRandomOrder()->first()->id,
        ];
    }
}
