<?php

namespace DeimosTest;

// phpUnit Fix
function is_uploaded_file($filename)
{
    return file_exists($filename);
}

class Simple extends \Deimos\Helper\Helpers\Uploads\Simple
{

    public function save($path)
    {
        return parent::save($path) || rename($this->tmpName(), $path);
    }

}
