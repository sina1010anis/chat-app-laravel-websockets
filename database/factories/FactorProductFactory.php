<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FactorProduct>
 */
class FactorProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $id;
    public function set_id_for_data(int $id){
        $this->id = $id;
    }
     public function definition(): array
    {
        return [
            'factor_id' => 1,
            'product_id' => $this->id,
        ];
    }
}
