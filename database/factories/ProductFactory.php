<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2,true)),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'price' => $this->faker->numberBetween(1000, 1000000)
        ];
    }
}
