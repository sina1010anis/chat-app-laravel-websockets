<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->text(rand(250 , 500)),
            'user_send' => rand(6 , 8),
            'user_get' => rand(6 , 8),
            'user_id' => rand(6 , 8),
        ];
    }
}
