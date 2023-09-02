<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\NewProduct;

class ProductController extends Controller
{
    public function new_product(Request $request, Product $product)
    {
        if (!$product->countProductByName($request)) {
            $product->newProduct($request);
            return (!$product->countProductByName($request)) ?:'Done';
        }
        return 'Validate Error';
    }

    public function show(Product $products)
    {
        return view('show_product' , ['products' => $products->latest('id')->get()]);
    }

    public function edit_product(Product $product)
    {
        return view('page_edit_product', compact('product'));
    }

    public function edit_product_post(Product $product, Request $request)
    {
        if ($product->countProductById($product)) {
            $product->updateProduct($product, $request);
            return (!$product->countProductById($product)) ?: redirect()->route('show.product')->with(['msg_ok' => 'Update Sucsess']);
        }
        return redirect()->route('show.product')->with(['msg_error' => 'Update Filde']);
    }
}
