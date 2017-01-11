<?php

namespace DeimosTest;

class Builder extends \Deimos\Builder\Builder
{

    /**
     * @return Helper
     *
     * @throws \InvalidArgumentException
     */
    public function helper()
    {
        return $this->once(function ()
        {
            return new Helper($this);
        }, __METHOD__);
    }

}