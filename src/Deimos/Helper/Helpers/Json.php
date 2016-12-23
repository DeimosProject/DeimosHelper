<?php

namespace Deimos\Helper\Helpers;

class Json implements InterfaceHelper
{

    /**
     * @var int
     */
    protected $options = JSON_UNESCAPED_UNICODE;

    /**
     * @param $data
     *
     * @return string
     */
    public function encode($data)
    {
        return json_encode($data, $this->options);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function decode($data)
    {
        return json_decode($data, $this->options);
    }

}