<?php

namespace DeimosTest;

use Deimos\Builder\Builder;
use Deimos\Helper\Helper;

class TestsSetUp extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Helper
     */
    protected $helper;

    public function setUp()
    {

        $builder = new Builder();
        $this->helper = new Helper($builder);

    }

}