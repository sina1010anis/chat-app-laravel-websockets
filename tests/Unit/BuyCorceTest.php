<?php

namespace Tests\Unit;

use App\Models\Corce;
use App\Models\Customer;
use App\Models\Factor;
use Tests\TestCase;
use Database\Factories\CorceFactory;
use Database\Factories\CustomerFactory;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class BuyCorceTest extends TestCase
{

    use DatabaseTruncation;
    /**
     * A basic unit test example.
     */
    public $corce_model;
    public $customer_model;
    public $customer;
    public $corce;

    public function setUp(): void
    {

        parent::setUp();
        $this->corce_model = new Corce;
        $this->customer_model = new Customer;
        $this->customer = CustomerFactory::new()->count(1)->create()->first();
        $this->corce = CorceFactory::new()->count(1)->create()->first();

    }
    public function testBuyUserVipCourceVip(): void
    {

        $this->assertTrue($this->corce_model->updateVip($this->corce));
        $this->assertTrue($this->customer_model->updateVip($this->customer, true));
        $this->corce_model->buyCorceVip($this->corce, $this->customer);
        $this->assertTrue($this->corce_model->getBuyStatus());

    }

    public function testBuyUserCorce(): void
    {

        $this->assertTrue($this->corce_model->buyCorce($this->corce, $this->customer));

    }
}
