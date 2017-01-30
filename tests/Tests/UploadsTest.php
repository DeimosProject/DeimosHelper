<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;
use DeimosTest\Simple;

class UploadsTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testMap()
    {
        $origin = __DIR__ . '/files/640_v2.jpg';
        $copy = __DIR__ . '/files/640_v2-copy.jpg';

        $to = __DIR__ . '/files/' . uniqid('_', true) . '.jpg';

        register_shutdown_function([$this, 'clear'], [$copy, $to]);

        copy($origin, $copy);

        $this->assertEquals(
            $this->helper()->uploads()->get('hello'),
            [], '', 0.0, 10, true
        );

        $size = filesize($copy);

        $_FILES = [
            'test' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => $size,
                'tmp_name' => $copy,
                'error' => 0
            ]
        ];

        $this->assertNull($this->_helper->uploads()->simple('notExists'));

        /**
         * @var $simple Simple
         */
        $simple = $this->_helper->uploads2()->simple('test');

        $this->assertEquals(
            0, $simple->error()
        );

        $this->assertEquals(
            'test.jpg', $simple->name()
        );

        $this->assertEquals(
            $size, $simple->size()
        );

        $this->assertEquals(
            'image/jpeg', $simple->type()
        );

        $simpleOrigin = $this->helper()->uploads()->simple('test');

        $upload = $this->_helper->uploads()->get('test');

        $this->assertEquals(
            $simple->name(),
            $upload[0]->name()
        );

        $this->assertFalse($simpleOrigin->save($to));
        $this->assertTrue($simple->save($to));

        $this->assertTrue(is_file($to));
        $this->assertFalse(is_file($copy));
    }

    public function testMultiple()
    {
        $file = __DIR__ . '/files/640_v2.jpg';
        $copy = __DIR__ . '/files/640_v2_copy.jpg';

        register_shutdown_function([$this, 'clear'], [$copy]);

        copy($file, $copy);

        $size = filesize($file);
        $copySize = filesize($copy);

        $_FILES = [
            'test' => [
                'name' => [
                    basename($file),
                    basename($copy),
                ],
                'type' => [
                    'image/jpeg',
                    'image/jpeg',
                ],
                'size' => [
                    $size,
                    $copySize,
                ],
                'tmp_name' => [
                    $file,
                    $copy,
                ],
                'error' => [0, 0]
            ]
        ];

        $file = $this->helper()->uploads()->simple('test', 1);

        $this->assertEquals(
            basename($copy),
            $file->name()
        );
    }

    public function clear(array $files)
    {
        foreach ($files as $file)
        {
            @unlink($file);
        }
    }
}
