<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Command>
 */
class CommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date" => fake()->date(),
            "amount" => fake()->randomFloat(2),
            "status" => fake()->randomElement(["in progress", "sent", "return", "delivered"]),
            "client_id" => Client::inRandomOrder()->first()->id,
        ];
    }
}
