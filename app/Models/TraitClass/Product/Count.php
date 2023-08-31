<?php

namespace App\Models\TraitClass\Product;

use App\Models\Product;
use Illuminate\Http\Request;

trait Count
{

    public function countProductByName(Product $product): bool
    {

        return !! (!$this->validateForNameAndPrice($product)) ?: $this->whereName($product->name)->count();

    }
    public function countProductById(Product $product): bool
    {

        return !! $this->whereId($product->id)->count();

    }
}
