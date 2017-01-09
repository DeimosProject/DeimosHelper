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
        return !(!@mkdir($path, 0777, true) && !is_dir($path));
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

}
