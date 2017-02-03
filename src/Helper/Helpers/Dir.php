<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Dir extends AbstractHelper
{

    /**
     * @param string $path
     *
     * @return bool
     */
    public function make($path)
    {
        return is_dir($path) || @mkdir($path, 0777, true);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isDir($path)
    {
        return is_dir($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function remove($path)
    {
        return rmdir($path);
    }

}
