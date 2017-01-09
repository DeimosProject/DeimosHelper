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

        $resultArray = $this->helper->arr()->filter($this->array, function ($var)
        {
            return ($var & 1);
        });

        foreach ($resultArray as $key => $value)
        {
            $this->assertEquals($value % 2, 1);
        }

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

    public function testFill()
    {

        $array = $this->helper->arr()->fill('a', 3);

        $this->assertEquals(
            $array,
            ['a','a','a',],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testRange()
    {

        $this->assertEquals(
            $this->helper->arr()->range(0,2),
            [0,1,2],
            '', $delta = 0.0, $maxDepth = 10, true
        );
    }

    public function testInStrict()
    {

        $result = $this->helper->arr()->inStrict($this->array, '1');

        $this->assertNotEquals($this->array[1], $result);

    }

    public function testIn()
    {

        $result = $this->helper->arr()->in($this->array, '1');

        $this->assertEquals($this->array[1], $result);

    }

    public function testShuffle()
    {

        $array = $this->helper->arr()->range(0, 999);
        $this->assertNotEquals(
            $array,
            $this->helper->arr()->shuffle($array),
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     * @throws ExceptionEmpty
     */
    public function testFindPath()
    {
        $this->helper->arr()->getRequired($this->array, '');
    }

}
