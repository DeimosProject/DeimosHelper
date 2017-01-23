<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class MathTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testSqr()
    {
        $this->assertEquals(4, $this->helper()->math()->sqr(2));
    }

    public function testSqrt()
    {
        $this->assertEquals(2, $this->helper()->math()->sqrt(4));
    }

    public function testPow()
    {
        $this->assertEquals(2 * 2 * 2, $this->helper()->math()->pow(2, 3));
    }

    public function testOdd()
    {
        $this->assertFalse($this->helper()->math()->isOdd(0));
        $this->assertTrue($this->helper()->math()->isOdd(1));
        $this->assertFalse($this->helper()->math()->isOdd(2));
        $this->assertTrue($this->helper()->math()->isOdd(3));
    }

    public function testEven()
    {
        $this->assertTrue($this->helper()->math()->isEven(0));
        $this->assertFalse($this->helper()->math()->isEven(1));
        $this->assertTrue($this->helper()->math()->isEven(2));
        $this->assertFalse($this->helper()->math()->isEven(3));
    }

}
