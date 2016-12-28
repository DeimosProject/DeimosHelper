<?php

use Deimos\Builder\Builder;
use Deimos\Helper\Exceptions\ExceptionEmpty;
use Deimos\Helper\Helpers\Arr;

class TestsSetUp extends \PHPUnit_Framework_TestCase
{

    protected $helper;

    public function setUp()
    {

        $builder = new Builder();
        $this->helper = new Arr();

    }

    public function map()
    {
        $array = [1,2,3,4];

        $arr =
    }

}