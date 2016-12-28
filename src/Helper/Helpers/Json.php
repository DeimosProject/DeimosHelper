<?php

namespace Deimos\Helper\Helpers;

class Json implements InterfaceHelper
{

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return int
     */
    protected function options()
    {
        $options = JSON_ERROR_NONE;

        foreach ($this->options as $option)
        {
            $options |= $option;
        }

        return $options;
    }

    /**
     * @param int $value
     */
    public function addOption($value)
    {
        $this->options[] = $value;
    }

    /**
     * @param array $options
     */
    public function setOption(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function encode($data)
    {
        return json_encode($data, $this->options());
    }

    /**
     * @param string $data
     * @param bool   $assoc
     *
     * @return mixed
     */
    public function decode($data, $assoc = true)
    {
        return json_decode($data, $assoc, 512, $this->options());
    }

}