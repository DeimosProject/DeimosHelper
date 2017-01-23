<?php

namespace DeimosTest;

class File extends \Deimos\Helper\Helpers\File
{

    public function isUploadedFile($path)
    {
        return parent::isUploadedFile($path) || true;
    }

}