<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class File extends AbstractHelper
{

    /**
     * @param string $path
     *
     * @return bool
     */
    public function touch($path)
    {
        return @touch($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function remove($path)
    {
        return unlink($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     *
     * @deprecated use File->isFile OR Dir->isDir, as it slowly
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * @param string $path
     *
     * @return int
     */
    public function size($path)
    {
        return filesize($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isReadable($path)
    {
        return is_readable($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isFile($path)
    {
        return is_file($path);
    }

}
