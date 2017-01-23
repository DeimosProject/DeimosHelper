<?php

namespace DeimosTest;

class Helper extends \Deimos\Helper\Helper
{

    /**
     * @return Arr
     */
    public function arr2()
    {
        return $this->once(function ()
        {
            return new Arr($this);
        }, __METHOD__);
    }

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

}