<?php

namespace App\Models\TraitClass\Product;

use App\Models\Product;
use Illuminate\Http\Request;

trait Count
{

    public function countProductByName($product): bool
    {
        return !! (!$this->validateForNameAndPrice($product)) ? false : $this->whereName($product->name)->count();
    }


    public function countProductById(Product $product): bool
    {

        return !! $this->whereId($product->id)->count();

    }
}
