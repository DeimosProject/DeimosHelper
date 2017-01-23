<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class DirTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testDir()
    {

        $dir = sys_get_temp_dir() . '/' . $this->helper()->str()->random(5);

        $this->assertTrue($this->helper()->dir()->make($dir));
        $this->assertTrue($this->helper()->dir()->isDir($dir));
        $this->assertTrue($this->helper()->dir()->remove($dir));

    }

}
