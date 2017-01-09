<?php

namespace Tests;

class DirTest extends \DeimosTest\TestsSetUp
{

    public function testDir()
    {

        $dir = sys_get_temp_dir() . '/' . $this->helper->str()->random(5);

        $this->assertTrue($this->helper->dir()->make($dir));
        $this->assertTrue($this->helper->dir()->isDir($dir));
        $this->assertTrue($this->helper->dir()->remove($dir));

    }

}
