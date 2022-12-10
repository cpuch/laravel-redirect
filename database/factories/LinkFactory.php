<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->unique()->word,
            'description' => fake()->sentence(),
            'default_url' => fake()->url(),
            'robot_url' => fake()->url(),
            'country_url' => [
                [
                    'code' => Country::all()->random()->code,
                    'url' => fake()->url(),
                ]
            ],
            'device_url' => [
                [
                    'code' => 'iphone',
                    'url' => fake()->url(),
                ]
            ],
        ];
    }
}
