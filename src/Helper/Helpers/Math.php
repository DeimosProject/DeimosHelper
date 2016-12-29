<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Math extends AbstractHelper
{

    /**
     * @param $base
     *
     * @return number
     */
    public function sqr($base)
    {
        return $this->pow($base, 2);
    }

    /**
     * @param $base
     * @param $exponent
     *
     * @return number
     */
    public function pow($base, $exponent)
    {
        return pow($base, $exponent);
    }

    /**
     * @param $argument
     *
     * @return float
     */
    public function sqrt($argument)
    {
        return sqrt($argument);
    }

}