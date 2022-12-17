<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'name' => fake()->name(),
                'price' => fake()->numberBetween(1,100000),
                'count' => fake()->numberBetween(1,20),
                'details' => fake()->paragraph(),
                'seller_id' => User::factory()
            ];
       
    }
}
