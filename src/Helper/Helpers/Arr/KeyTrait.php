<?php

namespace Deimos\Helper\Helpers\Arr;

trait KeyTrait
{

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function firstKey(array $storage)
    {
        reset($storage);

        return key($storage);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function lastKey(array $storage)
    {
        end($storage);

        return key($storage);
    }

    /**
     * @param array  $storage
     * @param string $key
     *
     * @return mixed
     */
    public function at(array $storage, $key)
    {
        return $storage[$key];
    }

    /**
     * 0=>'', 2=> ''...
     *
     * @param array $storage
     *
     * @return array
     */
    public function oddKey(array $storage)
    {
        return $this->filter($storage, function ($value, $key)
        {
            return $this->helper->math()->isOdd($key);
        });
    }

    /**
     * 1=>'', 3=>''...
     *
     * @param array $storage
     *
     * @return array
     */
    public function evenKey(array $storage)
    {
        return $this->filter($storage, function ($value, $key)
        {
            return $this->helper->math()->isEven($key);
        });
    }

    /**
     * @param array  $storage
     * @param string $key
     *
     * @return bool
     */
    public function keyExists(array $storage, $key)
    {
        return isset($storage[$key]) || $this->get($storage, $key) !== null;
    }

    /**
     * @param string $offset
     *
     * @return array
     */
    public function keys($offset)
    {
        $offset = preg_replace('~\[(?<s>[\'"]?)(.*?)(\k<s>)\]~u', '.$2', $offset);
        
        return explode('.', $offset);
    }

}
