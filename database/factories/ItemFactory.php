<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_code' => $this->faker->unique()->word(),
            'item_name' => $this->faker->word(),
            'unit' => $this->faker->word(),
            'category' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'unit_price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'total_price' => $this->faker->randomFloat(2, 1, 10000),
        ];
    }
}
