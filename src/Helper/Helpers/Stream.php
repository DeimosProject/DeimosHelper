<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;
use Deimos\Helper\Exceptions\NotFound;
use Deimos\Helper\Exceptions\PermissionDenied;

class Stream extends AbstractHelper
{

    /**
     * @param string $fromPath
     * @param string $toPath
     *
     * @return boolean
     *
     * @throws PermissionDenied
     * @throws NotFound
     */
    public function download($fromPath, $toPath)
    {
        $fromStream = $this->buffer($fromPath);

        if (!$fromStream)
        {
            throw new NotFound('File \'' . $fromPath . '\' not found');
        }

        if (!realpath($toPath) && !$this->helper->file()->touch($toPath))
        {
            throw new PermissionDenied('file \'' . $toPath . '\'');
        }

        file_put_contents($toPath, $fromStream);

        return fclose($fromStream);
    }

    /**
     * @param string $source
     * @param string $mode
     *
     * @return resource
     */
    protected function buffer($source, $mode = 'b')
    {
        return @fopen($source, $mode);
    }

}