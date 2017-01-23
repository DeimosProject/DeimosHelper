<?php

namespace Tests;

use Deimos\Helper\InterfaceHelper;
use Deimos\Helper\Traits\Helper;

class InterfaceTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testInterfaceTest()
    {
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->arr());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->str());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->dir());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->file());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->json());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->math());
        $this->assertInstanceOf(InterfaceHelper::class, $this->helper()->money());
    }

}
