<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $urlKey = fake()->word();

        return [
            'user_id' => User::first()->id,
            'original_url' => fake()->url,
            'url_key' => $urlKey,
            'short_url' => config('app.url').'/api/'.$urlKey,
        ];
    }
}
