<?php

namespace DeimosTest;

class Helper extends \Deimos\Helper\Helper
{

    /**
     * @return File
     */
    public function file2()
    {
        return $this->once(function ()
        {
            return new File($this);
        }, __METHOD__);
    }

    public function uploads2()
    {
        return $this->once(function ()
        {
            return new Uploads($this);
        }, __METHOD__);
    }

}