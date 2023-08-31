<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class NewProductTest extends TestCase
{
    use DatabaseTruncation;
    /**
     * A basic unit test example.
     */

    public $product_model;
    public $product;

    public function setUp(): void
    {

        parent::setUp();
        $this->product_model = new Product();
        $this->product = ProductFactory::new()->count(1)->make()->first();

    }
    public function testNewProductAndStoreInDatabase(): void
    {

        $this->assertFalse($this->product_model->countProductByName($this->product));
        $this->product_model->newProduct($this->product);
        $this->assertTrue($this->product_model->countProductByName($this->product));

    }

}
