<?php

namespace App\Models;

use App\Models\TraitClass\Product\Count;
use App\Models\TraitClass\Product\Validate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{

    use HasFactory, Validate, Count;
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
    public function newProduct(Product $product)
    {

        return (!$this->validateForNameAndPrice($product)) ?: $this->create([
                    'name' => $product->name,
                    'price' => $product->price
                ]);

    }

    public function getProduct($name)
    {

        return $this->whereName($name)->first();

    }

    public function updateProduct(Product $product, Request $request): bool
    {
        return $product->update(['name' => $request->name_new, 'price' => $request->price]);
    }

    public function checkHasName(Product $product, string $new_name): bool
    {
        return $product->name == $new_name;
    }
}
