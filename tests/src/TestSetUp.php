<?php

namespace DeimosTest;

use Deimos\Helper\Traits\Helper;

class TestSetUp extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DeimosTest\Helper
     */
    protected $_helper;

    public function setUp()
    {
        $this->builder = new Builder();

        $this->_helper = new \DeimosTest\Helper($this->builder);
    }

}