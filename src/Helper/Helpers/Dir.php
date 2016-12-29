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
        if (!@mkdir($path, 0777, true) && !is_dir($path))
        {
            return false;
        }

        return true;
    }

}