<?php

namespace DeimosTest;

class Arr extends \Deimos\Helper\Helpers\Arr\Arr
{

    /**
     * @return bool
     */
    protected function isHHVM()
    {
        return parent::isHHVM() || true;
    }

}