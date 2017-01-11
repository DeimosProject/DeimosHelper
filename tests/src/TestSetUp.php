<?php

namespace DeimosTest;

use Deimos\Helper\Traits\Helper;

class TestSetUp extends \PHPUnit_Framework_TestCase
{

    use Helper;

    public function setUp()
    {
        $this->builder = new Builder();
    }

}