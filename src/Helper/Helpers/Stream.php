<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Stream extends AbstractHelper
{

    /**
     * @param string $fromPath
     * @param string $toPath
     *
     * @return boolean
     */
    public function download($fromPath, $toPath)
    {
        $stream = fopen($fromPath, 'b');
        file_put_contents($toPath, $stream);

        return fclose($stream);
    }

}