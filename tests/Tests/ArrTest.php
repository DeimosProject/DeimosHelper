<?php

namespace Tests;

use Deimos\Helper\Exceptions\ExceptionEmpty;

class ArrTest extends \DeimosTest\TestsSetUp
{

    protected $array = [
        1, 2, 3, 4,
        'b' => 5,
        'p' => 6,
        7, 8, 9
    ];

    public function testMap()
    {

        $resultArray = $this->helper->arr()->map($this->array, function ($element)
        {

            return $element * $element;
        });

        foreach ($this->array as $key => $value)
        {

            $this->assertEquals($value * $value, $resultArray[$key]);
        }
    }

    public function testFilter()
    {

        $resultArray = $this->helper->arr()->odd($this->array);

        $this->helper->arr()->map($resultArray, function($value)
        {
            $this->assertEquals($this->helper->math()->isOdd($value), true);
        });

    }

    public function testKeyExists()
    {

        $this->assertTrue($this->helper->arr()->keyExists($this->array, 0));
        $this->assertTrue($this->helper->arr()->keyExists($this->array, 3));
        $this->assertNotTrue($this->helper->arr()->keyExists($this->array, 99));
        $this->assertNotTrue($this->helper->arr()->keyExists($this->array, 'a'));
        $this->assertNotTrue($this->helper->arr()->keyExists($this->array, ' '));
    }

    public function testGet()
    {

        $this->assertEquals($this->helper->arr()->get($this->array, 0), 1);
        $this->assertEquals($this->helper->arr()->get($this->array, 0, 'a'), 1);
        $this->assertEquals($this->helper->arr()->get($this->array, 'a', 'c'), 'c');
        $this->assertEquals($this->helper->arr()->get($this->array, 3, 'c'), 4);
        $this->assertNull($this->helper->arr()->get($this->array, 'c', null));
    }
    
    public function testGetRequired()
    {

        $this->helper->arr()->getRequired($this->array, 0);
        $this->helper->arr()->getRequired($this->array, 3);
        $this->helper->arr()->getRequired($this->array, 'b');

        try
        {

            $this->helper->arr()->getRequired($this->array, 'd');

            throw new \Exception();
        }
        catch (ExceptionEmpty $e)
        {
        }
    }

}
