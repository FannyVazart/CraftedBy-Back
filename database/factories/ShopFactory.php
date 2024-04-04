<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id');
        $themes = ['blue', 'green', 'red'];

        return [
        'name' => fake()->firstName(),
        'theme' => fake() -> randomElement($themes),
        'biography' => fake() -> text(300),
        'user_id' => fake() -> randomElement($userIds)
        ];
    }
}
