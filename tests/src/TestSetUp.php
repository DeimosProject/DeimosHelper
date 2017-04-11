<?php

namespace DeimosTest;

class TestSetUp extends \TestCase
{

    /**
     * @var Helper
     */
    protected $_helper;

    public function setUp()
    {
        defined('PHP_INT_MAX') OR define('PHP_INT_MAX', 9223372036854775807);
        defined('PHP_INT_MIN') OR define('PHP_INT_MIN', ~PHP_INT_MAX);

        $this->_helper = new Helper();
    }

}
