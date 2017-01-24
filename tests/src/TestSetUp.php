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
        defined('PHP_INT_MAX') OR define('PHP_INT_MAX', 9223372036854775807);
        defined('PHP_INT_MIN') OR define('PHP_INT_MIN', ~PHP_INT_MAX);
        
        $this->builder = new Builder();

        $this->_helper = new \DeimosTest\Helper($this->builder);
    }

}