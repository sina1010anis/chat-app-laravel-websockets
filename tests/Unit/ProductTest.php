<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
    /**
     * @property string name
     * @property array products
     * @property array assert
     * @property array data
     * @property Product product
     * @property Order order
     */
class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
        Product::create(['name' => 'M1' , 'price' => 3500]);
        Product::create(['name' => 'M2' , 'price' => 4500]);
        Product::create(['name' => 'M3' , 'price' => 2000]);
        $this->name = 'sina';
        $this->order = new Order;
        $this->product = new Product;
        $this->assert = collect([3500 , 4500 , 2000]);
        $this->data = $this->product->get();
    }
    public function testCheckNumberProduct()
    {
        $output = $this->product->sum_price($this->data);
        $res = $this->assert->sum();
        $this->assertEquals((int) $output ,(int) $res);
    }

}
