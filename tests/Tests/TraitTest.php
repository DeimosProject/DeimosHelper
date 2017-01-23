<?php

namespace Tests;

use DeimosTest\Builder;
use DeimosTest\Helper;
use DeimosTest\TestSetUp;

class TraitTest extends TestSetUp
{

    use \Deimos\Helper\Traits\Helper;

    public function setUp()
    {
        $this->builder = new Builder();
    }

    public function testHelper()
    {
        $this->assertInstanceOf(Helper::class, $this->helper());
    }

}