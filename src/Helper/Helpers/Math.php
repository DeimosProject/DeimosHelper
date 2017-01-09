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

    /**
     * 1, 3, 5...
     *
     * @param int $argument
     *
     * @return bool
     */
    public function isOdd($argument)
    {
        return !$this->isEven($argument);
    }

    /**
     * 0, 2, 4...
     *
     * @param int $argument
     *
     * @return bool
     */
    public function isEven($argument)
    {
        return !($argument & 1);
    }

}