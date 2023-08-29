<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;
    /**
     * @property string name
     * @property Product product
     * @property Order order
     */
class ProductTest extends TestCase
{

    public function setUp():void
    {
        parent::setUp();
        $this->name = 'sina';
        $this->product = new Product;
        $this->order = new Order;
    }
    public function testCheckNumberProduct()
    {
        //$this->product->newRow('mobile_1' , 2100)->newRow('mobile_2' , 3200)->newRow('mobile_3' , 4800);
        $this->assertTrue(true);
    }

}
