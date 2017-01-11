<?php

namespace Tests;

use Deimos\Helper\Exceptions\ExceptionEmpty;
use Deimos\Helper\Helpers\Arr\Arr;

class ArrTest extends \DeimosTest\TestSetUp
{

    protected $array = [
        1, 2, 3, 4,
        'b' => 5,
        'p' => 6,
        7, 8, 9
    ];

    public function testMap()
    {

        $resultArray = $this->helper()->arr()->map($this->array, function ($element)
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

        $resultArray = $this->helper()->arr()->filter($this->array, function ($var)
        {
            return ($var & 1);
        });

        foreach ($resultArray as $key => $value)
        {
            $this->assertEquals($value % 2, 1);
        }

    }

    public function testFilterHHVM()
    {

        if (!defined('HHVM_VERSION'))
        {
            define('HHVM_VERSION', 'hhvm');
        }

        $resultArray = $this->helper()->arr()->filter($this->array, function (&$var, $key)
        {
            return is_int($key);
        });

        foreach ($resultArray as $key => $value)
        {
            $this->assertTrue(is_int($key));
        }

    }

    public function testKeyExists()
    {

        $this->assertTrue($this->helper()->arr()->keyExists(
            $this->helper()->arr()->range(0, 5),
            3
        ));
        $this->assertTrue($this->helper()->arr()->keyExists($this->array, 0));
        $this->assertTrue($this->helper()->arr()->keyExists($this->array, 3));
        $this->assertNotTrue($this->helper()->arr()->keyExists($this->array, 99));
        $this->assertNotTrue($this->helper()->arr()->keyExists($this->array, 'a'));
        $this->assertNotTrue($this->helper()->arr()->keyExists($this->array, ' '));
    }

    public function testGet()
    {

        $this->assertEquals($this->helper()->arr()->get($this->array, 0), 1);
        $this->assertEquals($this->helper()->arr()->get($this->array, 0, 'a'), 1);
        $this->assertEquals($this->helper()->arr()->get($this->array, 'a', 'c'), 'c');
        $this->assertEquals($this->helper()->arr()->get($this->array, 3, 'c'), 4);
        $this->assertNull($this->helper()->arr()->get($this->array, 'c', null));
    }

    public function testGetRequired()
    {

        $this->helper()->arr()->getRequired($this->array, 0);
        $this->helper()->arr()->getRequired($this->array, 3);
        $this->helper()->arr()->getRequired($this->array, 'b');

        try
        {

            $this->helper()->arr()->getRequired($this->array, 'd');

            throw new \Exception();
        }
        catch (ExceptionEmpty $e)
        {
        }
    }

    public function testFill()
    {

        $array = $this->helper()->arr()->fill('a', 3);

        $this->assertEquals(
            $array,
            ['a', 'a', 'a',],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testRange()
    {

        $this->assertEquals(
            $this->helper()->arr()->range(0, 2),
            [0, 1, 2],
            '', $delta = 0.0, $maxDepth = 10, true
        );
    }

    public function testInStrict()
    {

        $result = $this->helper()->arr()->inStrict($this->array, '1');

        $this->assertNotEquals($this->array[1], $result);

    }

    public function testIn()
    {

        $result = $this->helper()->arr()->in($this->array, '1');

        $this->assertEquals($this->array[1], $result);

    }

    public function testShuffle()
    {

        $array = $this->helper()->arr()->range(0, 999);
        $this->assertNotEquals(
            $array,
            $this->helper()->arr()->shuffle($array),
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     * @throws ExceptionEmpty
     */
    public function testFindPath()
    {

        $reflection = new \ReflectionMethod(Arr::class, 'findPath');
        $reflection->setAccessible(true);

        $reflection->invoke($this->helper()->arr(), [], []);
    }

    public function testSet()
    {
        $storage = ['a' => ['b' => 1]];

        $this->helper()->arr()->set($storage, 'a.b', 2);
        $this->helper()->arr()->set($storage, 'a.c', 1);
        $this->helper()->arr()->set($storage, 'a.d.e.f.g', ['a' => ['b' => 1]]);

        $this->assertEquals(
            $this->helper()->arr()->get($storage, 'a.b'),
            2
        );

        $this->assertEquals(
            $this->helper()->arr()->get($storage, 'a.c'),
            1
        );

        $this->assertEquals(
            $this->helper()->arr()->get($storage, 'a.d.e.f.g.a.b'),
            1
        );
    }

    public function testFirstKey()
    {

        $this->assertEquals(
            $this->helper()->arr()->firstKey($this->array),
            0
        );

        $this->assertEquals(
            $this->helper()->arr()->firstKey(['a' => 0, 'w' => 5, 1, 4, 6]),
            'a'
        );

        $this->assertNotEquals(
            $this->helper()->arr()->firstKey(['a' => 0, 'w' => 5, 1, 4, 6]),
            0
        );

    }

    public function testLastKey()
    {

        $this->assertEquals(
            $this->helper()->arr()->lastKey($this->array),
            6
        );

        $this->assertEquals(
            $this->helper()->arr()->lastKey(['a' => 0, 1, 4, 6, 'w' => 5]),
            'w'
        );

        $this->assertNotEquals(
            $this->helper()->arr()->lastKey(['a' => 0, 'w' => 5, 1, 4, 6]),
            0
        );

    }

    public function testAt()
    {

        $this->assertEquals(
            $this->helper()->arr()->at($this->array, 2),
            3
        );

    }

    public function testOddKey()
    {

        $array = $this->helper()->arr()->oddKey($this->helper()->arr()->range(0, 10));

        $this->assertEquals(
            $array,
            $this->helper()->arr()->range(1, 10, 2),
            '', $delta = 0.0, $maxDepth = 10, true
        );

        $this->assertNotEquals(
            $array,
            $this->helper()->arr()->range(0, 10, 2),
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testEvenKey()
    {

        $array = $this->helper()->arr()->evenKey($this->helper()->arr()->range(0, 10));

        $this->assertEquals(
            $array,
            $this->helper()->arr()->range(0, 10, 2),
            '', $delta = 0.0, $maxDepth = 10, true
        );

        $this->assertNotEquals(
            $array,
            $this->helper()->arr()->range(1, 10, 2),
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testPush()
    {

        $array = [1];

        $index = $this->helper()->arr()->push($array, 2);

        $this->assertCount($index, $array);

        $this->assertEquals(
            $array,
            [1, 2],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testPop()
    {

        $array = [1, 2];

        $index = $this->helper()->arr()->pop($array);

        $this->assertEquals(
            $index,
            2
        );

        $this->assertEquals(
            $array,
            [1],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testUnShift()
    {

        $array = [1];

        $index = $this->helper()->arr()->unShift($array, 2);

        $this->assertCount($index, $array);

        $this->assertEquals(
            $array,
            [2, 1],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testShift()
    {

        $array = [1, 2];

        $index = $this->helper()->arr()->shift($array);

        $this->assertEquals(
            $index,
            1
        );

        $this->assertEquals(
            $array,
            [2],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testFirst()
    {

        next($this->array);

        $this->assertEquals(
            $this->helper()->arr()->first($this->array),
            1
        );

        $this->assertEquals(
            current($this->array),
            2
        );

        $this->assertEquals(
            $this->helper()->arr()->firstKey($this->array),
            0
        );

        $this->assertEquals(
            current($this->array),
            2
        );

    }

    public function testLast()
    {

        next($this->array);

        $this->assertEquals(
            $this->helper()->arr()->last($this->array),
            9
        );

        $this->assertEquals(
            current($this->array),
            2
        );

        $this->assertEquals(
            $this->helper()->arr()->lastKey($this->array),
            6 // last INT key
        );

        $this->assertEquals(
            current($this->array),
            2
        );

    }

    public function testOdd()
    {

        $this->assertEquals(
            $this->helper()->arr()->odd([1, 2, 3, 4]),
            [1, 3],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

    public function testEven()
    {

        $this->assertEquals(
            $this->helper()->arr()->even([1, 2, 3, 4]),
            [2, 4],
            '', $delta = 0.0, $maxDepth = 10, true
        );

    }

}
