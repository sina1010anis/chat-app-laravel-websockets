<?php

namespace App\Models\TraitClass\Product;

use Illuminate\Http\Request;

trait Validate
{
    public function validateForNameAndPrice($data)
    {

        return $data->name != '' && $data->price > 0;

    }

    public function validateForName(Request $request)
    {

        return isset($request->name);

    }
}
