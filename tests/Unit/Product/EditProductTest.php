<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\Request;
use Tests\TestCase;

class EditProductTest extends TestCase
{

    //use DatabaseTruncation;
    /**
     * A basic unit test example.
     */

     public $request;
     public $product;
     public $product_model;
    public function setUp(): void
    {
        parent::setUp();
        $this->product_model = new Product();
        $this->product = $this->product_model->find(1);
        $this->request = new Request();
        $this->request['name'] = 'M3';
        $this->request['price'] = 3500;
    }

    public function testEditProduct(): void
    {
        $this->assertTrue($this->product_model->countProductById(
            $this->product
        ));
        $this->assertTrue($this->product_model->updateProduct(
            $this->product,
            $this->request
        ));
        $this->assertDatabaseHas('products', [
            'name' => $this->product->name,
        ]);
    }
}
