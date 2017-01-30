<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class StreamTest extends \DeimosTest\TestSetUp
{

    use Helper;

    private $from = __DIR__ . '/files/640_v2.jpg';

    public function testStream()
    {
        $to = __DIR__ . '/files/' . uniqid(mt_rand(), true) . '.jpg';

        register_shutdown_function([$this, 'clear'], [$to]);

        $this->helper()->stream()->download($this->from, $to);

        $this->assertTrue(is_file($to));

        $this->assertEquals(
            filesize($this->from),
            filesize($to)
        );
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\NotFound
     */
    public function testNotFound()
    {
        $this->helper()->stream()->download('/NOT_FOUND_FILE' . uniqid(mt_rand(), true), __DIR__ . '/files/delete');
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\PermissionDenied
     */
    public function testPermissionDenied()
    {
        $this->helper()->stream()->download($this->from, '/pex');
    }

    public function clear(array $files)
    {
        foreach ($files as $file)
        {
            @unlink($file);
        }
    }
}
