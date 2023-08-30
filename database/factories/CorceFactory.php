<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Corce>
 */
class CorceFactory extends Factory
{
    use setRole;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'price' => rand(1000,9000),
            'type' => $this->role[rand(0,1)],
        ];
    }
}
