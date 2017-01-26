<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Stream extends AbstractHelper
{

    /**
     * @param string $source
     * @param string $mode
     *
     * @return resource
     */
    protected function buffer($source, $mode = 'b')
    {
        return fopen($source, $mode);
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     *
     * @return boolean
     */
    public function download($fromPath, $toPath)
    {
        $fromStream = $this->buffer($fromPath);

        file_put_contents($toPath, $fromStream);

        return fclose($fromStream);
    }

}