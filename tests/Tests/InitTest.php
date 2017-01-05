<?php

namespace Tests;

use Deimos\Helper\Helper;

class InitTest extends \DeimosTest\TestsSetUp
{

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Instanceof SELF
     */
    public function testException()
    {
        new Helper($this->helper);
    }

}
