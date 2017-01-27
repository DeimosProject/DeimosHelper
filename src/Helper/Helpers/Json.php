<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Json extends AbstractHelper
{

    const OPTIONS_ENCODE = 0;
    const OPTIONS_DECODE = 1;

    /**
     * first[level]     array      option type
     * second[level]    array      option value
     *
     * @var int[][]
     */
    protected $options = [];

    /**
     * @param int $value
     * @param int $target
     */
    public function addOption($value, $target = self::OPTIONS_ENCODE)
    {
        $this->helper->arr()->initOrPush($this->options, $target, $value);
    }

    /**
     * @param array|int $data
     * @param int       $target
     */
    public function setOption($data, $target = self::OPTIONS_ENCODE)
    {
        $this->options[$target] = (array)$data;
    }

    /**
     * reset options
     */
    public function reset()
    {
        $this->options = [];
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function encode($data)
    {
        return json_encode($data, $this->encodeOptions());
    }

    /**
     * @return int
     */
    private function encodeOptions()
    {
        return $this->options(self::OPTIONS_ENCODE);
    }

    /**
     * @param int $target
     *
     * @return int
     */
    protected function options($target)
    {
        $options = JSON_ERROR_NONE;

        if (isset($this->options[$target]))
        {
            foreach ($this->options[$target] as $option)
            {
                $options |= $option;
            }
        }

        return $options;
    }

    /**
     * @param string $data
     * @param bool   $assoc
     *
     * @return mixed
     */
    public function decode($data, $assoc = true)
    {
        return json_decode($data, $assoc, 512, $this->decodeOptions());
    }

    /**
     * @return int
     */
    private function decodeOptions()
    {
        return $this->options(self::OPTIONS_DECODE);
    }

}