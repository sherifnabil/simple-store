<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' =>  $this->faker->words(
                nb: 3,
                asText: true
            ),

            'price' =>  $this->faker->numberBetween(
                int1: 100,
                int2: 500
            ),

            'active'    =>  $this->faker->boolean(),

            'stock' =>  $this->faker->numberBetween(
                int1: 100,
                int2: 500
            )
        ];
    }
}
