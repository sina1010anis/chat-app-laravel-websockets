<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factor>
 */
class FactorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $price , $id, $customer;
     public function setDatas($price , $id, $customer){
        $this->price=$price ;
        $this->id=$id;
        $this->customer=$customer;
     }
    public function definition(): array
    {
        return [
            'total_price' => 5000,
            'pyment_id' => Str::password(15),
            'product_id' => 1,
            'customer_id' => 1,
        ];
    }
}
