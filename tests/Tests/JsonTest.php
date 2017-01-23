<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class JsonTest extends \DeimosTest\TestSetUp
{

    use Helper;

    protected $array = [
        1, 2, 3,
        4, 5, 6,
        'a' => 7, 8, 9,
        'Бесплатно'
    ];

    public function testOptions()
    {

        $this->helper()->json()->reset();
        $this->helper()->json()->addOption(JSON_PRETTY_PRINT);
        $resultString = $this->helper()->json()->encode($this->array);
        $this->assertEquals(json_encode($this->array, JSON_PRETTY_PRINT), $resultString);

        $this->helper()->json()->addOption(JSON_FORCE_OBJECT);
        $resultString = $this->helper()->json()->encode($this->array);
        $this->assertEquals(json_encode($this->array, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT), $resultString);

        $this->helper()->json()->reset();
        $this->helper()->json()->addOption(JSON_PRETTY_PRINT);
        $this->helper()->json()->addOption(JSON_UNESCAPED_UNICODE);
        $resultString = $this->helper()->json()->encode($this->array);
        $this->assertEquals(json_encode($this->array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $resultString);

        $this->helper()->json()->setOption(JSON_ERROR_NONE);
        $resultString = $this->helper()->json()->encode($this->array);
        $this->assertEquals(json_encode($this->array), $resultString);

        $this->assertEquals(
            $this->array,
            $this->helper()->json()->decode(json_encode($this->array)),
            '', 0.0, 10, true
        );

    }

}
