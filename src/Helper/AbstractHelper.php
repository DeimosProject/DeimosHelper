<?php

namespace Deimos\Helper;

abstract class AbstractHelper implements InterfaceHelper
{

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * AbstractHelper constructor.
     *
     * @param $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

}