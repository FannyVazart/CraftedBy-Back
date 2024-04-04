<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
        $shopIds = DB::table('shops')->pluck('id');

        return [
            'name' => fake()-> lastName(),
            'description' => fake() -> text(30),
            'price' => random_int(1, 70),
            'shop_id' => fake() -> randomElement($shopIds)
        ];
    }
}
