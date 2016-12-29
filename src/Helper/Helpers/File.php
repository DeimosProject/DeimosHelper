<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class File extends AbstractHelper
{

    /**
     * @param $path
     *
     * @return bool
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * @param $path
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
    public function readable($path)
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
        return (is_file($path) && !$this->helper->dir()->isDir($path));
    }

}
