<?php

namespace App\Models;

use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    public $price_model = 0;
    protected $fillable = [
        'name',
        'price',
    ];

    public function newRow($name, $price)
    {

        $this->create([
            'name' => $name,
            'price' => $price,
        ]);
        return $this;

    }

    public function sum_price($products)
    {

        foreach ($products as $product) {

            $this->price_model += $product->price;

        }
        return $this->price_model;

    }

    public function getPriceModel()
    {

        return $this->price_model;

    }

    public function validate($data)
    {

        return $data->name != '' && $data->price > 0;

    }
    public function countProduct(Product $product): bool
    {

        return !! (!$this->validate($product)) ?: $this->whereName($product->name)->count();

    }

    public function newProduct(Product $product)
    {

        return (!$this->validate($product)) ?: $this->create([
                    'name' => $product->name,
                    'price' => $product->price
                ]);

    }

    public function getProduct($name)
    {

        return (!isset($name)) ?: $this->whereName($name)->first();

    }
}
