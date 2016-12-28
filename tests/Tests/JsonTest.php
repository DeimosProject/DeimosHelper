<?php

namespace Tests;

class JsonTest extends \DeimosTest\TestsSetUp
{

    protected $array = [
        1, 2, 3,
        4, 5, 6,
        7, 8, 9
    ];

    public function testOptions()
    {

        $this->helper->json()->addOption(JSON_PRETTY_PRINT);
        $resultString = $this->helper->json()->encode($this->array);
        $this->assertJsonStringEqualsJsonString(json_encode($this->array, JSON_PRETTY_PRINT), $resultString);

        $this->helper->json()->addOption(JSON_FORCE_OBJECT);
        $resultString = $this->helper->json()->encode($this->array);
        $this->assertJsonStringEqualsJsonString(json_encode($this->array, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT), $resultString);

        $this->helper->json()->setOption(JSON_ERROR_NONE);
        $resultString = $this->helper->json()->encode($this->array);
        $this->assertJsonStringEqualsJsonString(json_encode($this->array), $resultString);

    }

}
