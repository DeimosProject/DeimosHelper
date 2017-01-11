<?php

namespace Tests;

use Deimos\Helper\Helper;

class InitTest extends \DeimosTest\TestSetUp
{

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Instanceof SELF
     */
    public function testException()
    {
        new Helper($this->helper());
    }

}
