<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $price_model=0;
    protected $fillable = [
        'name',
        'price',
    ];

    public function newRow($name , $price)
    {
        $this->create([
            'name' => $name,
            'price' => $price,
        ]);
        return $this;
    }

    public function sum_price($products)
    {
        foreach($products as $product) {
            $this->price_model += $product->price;
        }
        return $this->price_model;
    }

    public function getPriceModel()
    {
        return $this->price_model;
    }


}
