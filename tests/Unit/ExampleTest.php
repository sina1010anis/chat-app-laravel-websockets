<?php

namespace Tests\Unit;

use App\Http\Controllers\TestController;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testIndex(): void
    {
        $number_1 = (float) 98.3598;
        $number_2 = (float) 2.88;
        $test_controoler = new TestController();

        $output = $test_controoler->index($number_1 , $number_2);
        $res = (float) number_format($number_1/$number_2 , 3);

        $this->assertEquals($res , $output);
    }
}
