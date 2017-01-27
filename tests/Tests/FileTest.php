<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;
use DeimosTest\BuilderWithoutHelper;
use DeimosTest\File;

class FileTest extends \DeimosTest\TestSetUp
{

    use Helper;

    private $key = 'upload';

    public function testFile()
    {

        $file = sys_get_temp_dir() . '/' . $this->helper()->str()->random(5);

        $this->assertFalse($this->helper()->file()->exists($file));
        $this->assertFalse($this->helper()->file()->isReadable($file));

        $this->assertTrue($this->helper()->file()->touch($file));
        $this->assertTrue($this->helper()->file()->exists($file));
        $this->assertTrue($this->helper()->file()->isFile($file));
        $this->assertTrue($this->helper()->file()->isReadable($file));

        $this->assertEquals($this->helper()->file()->size($file), 0);

        $this->assertTrue($this->helper()->file()->remove($file));

        $this->assertFalse($this->helper()->file()->exists($file));

    }

    private function writeFile($name)
    {
        $blankGif = 'R0lGODdhAQABAIAAAP///////ywAAAAAAQABAAACAkQBADs=';

        $file = sys_get_temp_dir() . '/' . $name;

        file_put_contents($file, base64_decode($blankGif));
    }

    private function getFile2()
    {
        $this->builder = new BuilderWithoutHelper();
        $file = $this->helper()->str()->random(5);
        $this->writeFile($file);

        /**
         * @var File
         */
        $file2 = $this->_helper->file2();
        $_FILES[$this->key] = [
            'tmp_name' => $file,
            'name' => 'blankFile.gif',
            'type' => 'image/gif',
            'size' => 35,
            'error' => 0
        ];

        return [$file, $file2];
    }

    public function testUpload()
    {
        /**
         * @var string $file
         * @var File $file2
         */
        list($file,$file2) = $this->getFile2();

//        // FAKE TEST's
//        $this->assertTrue($file2->isUploadedFile($file));
//        $this->assertFalse($file2->saveUploadedFile($this->key, $file.'_'));
//        // /
//
//        $this->assertTrue($file2->uploadedKeyExist($this->key));
//        $this->assertEquals($file2->getUploadedFileName($this->key), 'blankFile.gif');
//        $this->assertEquals($file2->getUploadedFileSize($this->key), 35);
//        $this->assertEquals($file2->getUploadedFileError($this->key), 0);
    }

    /**
     * expectedException \InvalidArgumentException
     */
    public function testErrorSave()
    {
        /**
         * @var string $file
         * @var File $file2
         */
        list($file,$file2) = $this->getFile2();

//        $file2->saveUploadedFile('', '');
    }

    /**
     * expectedException \InvalidArgumentException
     */
    public function testErrorName()
    {
        /**
         * @var string $file
         * @var File $file2
         */
        list($file,$file2) = $this->getFile2();

//        $file2->getUploadedFileName('');
    }

    /**
     * expectedException \InvalidArgumentException
     */
    public function testErrorSize()
    {
        /**
         * @var string $file
         * @var File $file2
         */
        list($file,$file2) = $this->getFile2();

//        $file2->getUploadedFileSize('');
    }

    /**
     * expectedException \InvalidArgumentException
     */
    public function testError()
    {
        /**
         * @var string $file
         * @var File $file2
         */
        list($file,$file2) = $this->getFile2();

//        $file2->getUploadedFileError('');
    }

}
