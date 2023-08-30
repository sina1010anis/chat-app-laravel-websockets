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
    /**
     * @property Corce $corce_model
     * @property Customer $customer_model
     * @property mixed $customer
     * @property mixed $corce
     */
    public function setUp():void
    {
        parent::setUp();
        $this->corce_model = new Corce;
        $this->customer_model = new Customer;
        $this->customer = CustomerFactory::new()->count(1)->create()->first();
        $this->corce = CorceFactory::new()->count(1)->create()->first();
    }
    /**@test */
    public function test_buy_user_vip_cource_vip():void
    {

        $this->corce_model->updateVip($this->corce);
        $this->assertTrue($this->customer_model->updateVip($this->customer , true));

        $this->corce_model->buyCorceVip($this->corce , $this->customer);
        $this->assertTrue($this->corce_model->getBuy_status());
    }
}
