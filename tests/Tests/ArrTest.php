<?php

namespace Tests;

use Deimos\Helper\Exceptions\ExceptionEmpty;

class ArrTest extends \DeimosTest\TestsSetUp
{

    protected $array = [
        1,2,3,4,
        'b'=>5,
        'p'=>6,
        7,8,9
    ];

    public function testMap()
    {
        $resultArray = $this->helper->arr()->map($this->array, function ($element)
        {

            return $element * $element;
        });

        foreach ($this->array as $key => $value)
        {

            assert(($value * $value) === $resultArray[$key]);
        }
    }

    public function testFilter()
    {

        $resultArray = $this->helper->arr()->filter($this->array, function ($var)
        {

            return ($var & 1);
        });

        foreach ($resultArray as $key => $value)
        {

            assert(($key%2) === 1);
        }

    }

    public function testKeyExists()
    {

        assert($this->helper->arr()->keyExists($this->array, 0));
        assert($this->helper->arr()->keyExists($this->array, 3));
        assert(!$this->helper->arr()->keyExists($this->array, 99));
        assert(!$this->helper->arr()->keyExists($this->array, 'a'));
        assert(!$this->helper->arr()->keyExists($this->array, ' '));
    }

    public function testGet()
    {
        assert($this->helper->arr()->get($this->array, 0) === 1);
        assert($this->helper->arr()->get($this->array, 0, 'a') === 1);
        assert($this->helper->arr()->get($this->array, 'a', 'c') === 'c');
        assert($this->helper->arr()->get($this->array, 3, 'c') === 4);
        assert($this->helper->arr()->get($this->array, 'c', null) === null);
    }

    public function testGetRequired()
    {
        $this->helper->arr()->getRequired($this->array, 0);
        $this->helper->arr()->getRequired($this->array, 3);
        $this->helper->arr()->getRequired($this->array, 'b');

        try {

            $this->helper->arr()->getRequired($this->array, 'd');

            throw new \Exception();
        } catch (ExceptionEmpty $e) {}
    }
}