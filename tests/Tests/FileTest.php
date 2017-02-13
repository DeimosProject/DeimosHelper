<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class FileTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testFile()
    {

        $file = sys_get_temp_dir() . '/' . $this->helper()->str()->random(5);

        $this->assertFalse($this->helper()->file()->isFile($file));
        $this->assertFalse($this->helper()->file()->isReadable($file));

        $this->assertTrue($this->helper()->file()->touch($file));
        $this->assertTrue($this->helper()->file()->isFile($file));
        $this->assertTrue($this->helper()->file()->isFile($file));
        $this->assertTrue($this->helper()->file()->isReadable($file));

        $this->assertEquals($this->helper()->file()->size($file), 0);

        $this->assertTrue($this->helper()->file()->remove($file));

        $this->assertFalse($this->helper()->file()->isFile($file));

    }

}
